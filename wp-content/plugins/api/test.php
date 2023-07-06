<?php
/**
 * Plugin Name: Tender Importer
 * Description: Import tenders from a JSON API and create products in WooCommerce.
 * Version: 1.0.0
 * Author: Your Name
 */

// Register custom product fields
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

// Save custom product fields data
function save_custom_product_fields($post_id)
{
    // Save custom fields
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

// Import tenders from JSON API
function import_tenders()
{
    $api_url = 'https://www.biddetail.com/kenya/C62A8CB5DD405E768CAD792637AC0446/F4454993C1DE1AB1948A9D33364FA9CC';

    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        // Handle error
        return;
    }

    // $body = wp_remote_retrieve_body($response);
    // $tender_lists// Convert JSON data to array
    $tender_lists = json_decode(wp_remote_retrieve_body($response), true);

    if (!is_array($tender_lists)) {
        // Handle error
        return;
    }

    // Loop through tenders and create products
    foreach ($tender_lists as $tender) {
        // Check if product exists
        if (get_page_by_title($tender['tender_name'], OBJECT, 'product') !== null) {
            continue;
        }

        // Create product
        $product = array(
            'post_title' => $tender['tender_name'],
            'post_content' => $tender['tender_description'],
            'post_excerpt' => $tender['tender_short_description'],
            'post_status' => 'publish',
            'post_type' => 'product',
        );

        // Add custom fields to product
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

        // Insert product
        $product_id = wp_insert_post($product);

        // Save custom fields
        save_custom_product_fields($product_id);
    }
}
add_action('admin_init', 'import_tenders');