<?php
/**
 * Plugin Name: Kenyan Tender Importer
 * Description: Import tenders from a JSON API and create products in WooCommerce.
 * Version: 1.0.0
 * Author: Michael Saiba 
 */

function add_custom_product_fields()
{
    woocommerce_wp_text_input(
        array(
            'id' => 'bdr',
            'label' => __('BDR No', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the BDR No for this tender', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'tender_no',
            'label' => __('Tender No', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the Tender No for this tender', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'purchase_authority',
            'label' => __('Purchasing Authority', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the Purchasing Authority for this tender', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'competition_type',
            'label' => __('Competition Type', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the Competition Type for this tender', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'category',
            'label' => __('Tender Category', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the Tender Category for this tender', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'funding',
            'label' => __('Funding', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the Funding for this tender', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'address',
            'label' => __('Geographical Addresses', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the Geographical Addresses for this tender', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'email',
            'label' => __('Email Address', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the Email Address for this tender', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'phone',
            'label' => __('Mobile Contacts', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the Mobile Contacts for this tender', 'woocommerce'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'tender_expiry',
            'label' => __('Tender Expiry', 'woocommerce'),
            'desc_tip' => 'true',
            'description' => __('Enter the Tender Expiry for this tender', 'woocommerce'),
        )
    );
}
add_action('woocommerce_product_options_general_product_data', 'add_custom_product_fields');

function save_custom_product_fields($post_id)
{
    $custom_fields = array(
        'bdr' => 'BDR_No',
        'tender_no' => 'Tender_No',
        'purchase_authority' => 'Purchasing_Authority',
        'competition_type' => 'CompetitionType',
        'category' => 'Tender_Category',
        'funding' => 'Funding',
        'address' => 'Geographical_Addresses',
        'email' => 'Email_Address',
        'phone' => 'Mobile_Contacts',
        'tender_expiry' => 'Tender_Expiry',
    );

    foreach ($custom_fields as $field_id => $field_name) {
        if (isset($_POST[$field_id])) {
            update_post_meta($post_id, $field_id, sanitize_text_field($_POST[$field_id]));
        }
    }
}

function import_tenders()
{
    $api_url = API_URL;


    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        return;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    $tender_lists = $data['TenderDetails'][0]['TenderLists'];

    if (!is_array($tender_lists)) {
        return;
    }
    foreach ($tender_lists as $tender) {

        $existing_product = get_posts(
            array(
                'post_type' => 'product',
                'meta_query' => array(
                    array(
                        'key' => 'bdr',
                        'value' => sanitize_text_field($tender['BDR_No']),
                    ),
                ),
            )
        );

        if (!empty($existing_product)) {
            continue; 
        }

        $product = array(
            'post_title' => $tender['Tender_Brief'],
            'post_content' => $tender['Work_Detail'],
            'post_status' => 'publish',
            'post_type' => 'product',
        );

        $product['meta_input'] = array(
            'bdr' => sanitize_text_field($tender['BDR_No']),
            'tender_no' => sanitize_text_field($tender['Tender_No']),
            'purchase_authority' => sanitize_text_field($tender['Purchasing_Authority']),
            'competition_type' => sanitize_text_field($tender['CompetitionType']),
            'category' => sanitize_text_field($tender['Tender_Category']),
            'funding' => sanitize_text_field($tender['Funding']),
            'address' => sanitize_text_field($tender['Geographical_Addresses']),
            'email' => sanitize_text_field($tender['Email_Address']),
            'phone' => sanitize_text_field($tender['Mobile_Contacts']),
            'tender_expiry' => sanitize_text_field($tender['Tender_Expiry']),
        );

        $product_id = wp_insert_post($product);

        if (is_wp_error($product_id)) {
            continue;
        }

        update_post_meta($product_id, '_regular_price', 500);
        $download = array(
            'id' => $tender['BDR_No'],
            'name' => 'tenderfile',
            'file' => $tender['FileUrl'],
        );
        update_post_meta($product_id, '_downloadable_files', array($download));
        save_custom_product_fields($product_id);

        return;
    }
    
}
add_action('admin_menu', 'add_tender_import_page');