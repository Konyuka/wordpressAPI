<?php

/*
Plugin Name: Api Plugin
Plugin URI: 
Description: Parse Data from REST endpoints
Version: 1.0
Author: Miichael Saiba 
Author URI:  
License: GPLv2
*/

function my_function()
{

    $response = wp_remote_get('https://www.biddetail.com/kenya/C62A8CB5DD405E768CAD792637AC0446/F4454993C1DE1AB1948A9D33364FA9CC');
    if (is_wp_error($response)) {
        echo 'Something went wrong...';
        return;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    $tender_lists = $data['TenderDetails'][0]['TenderLists'];

    // var_dump($products);
    // die();
    // return;

    add_action('woocommerce_product_options_general_product_data', 'add_custom_product_fields');
    add_action('woocommerce_process_product_meta', 'save_custom_product_fields');

    foreach ($tender_lists as $tender) {

        $download = array(
            'id' => $tender['BDR_No'],
            'name' => 'tenderfile',
            'file' => $tender['FileUrl'],
        );

        $product = array(
            'name' => $tender['Tender_Brief'],
            'description' => $tender['Work_Detail'],
            'price' => $tender['Tender_Value'],
            'regular_price' => 500,
            'downloads' => array($download),
            'date_on_sale_to' => $tender['Tender_Expiry'],
        );

        // Add custom fields to product data settings
        // add_action('woocommerce_product_options_general_product_data', 'add_custom_product_fields');

        function add_custom_product_fields()
        {
            global $woocommerce, $post;

            woocommerce_wp_text_input(
                array(
                    'id' => 'bdr',
                    'label' => __('BDR No.', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the BDR No. for this product.', 'woocommerce')
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id' => 'tender_no',
                    'label' => __('Tender No.', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the Tender No. for this product.', 'woocommerce')
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id' => 'purchase_authority',
                    'label' => __('Purchase Authority', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the Purchase Authority for this product.', 'woocommerce')
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id' => 'competition_type',
                    'label' => __('Competiton Type', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the competition type for this product.', 'woocommerce')
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id' => 'category',
                    'label' => __('Category', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the category for this product.', 'woocommerce')
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id' => 'funding',
                    'label' => __('Funding', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the funding for this product.', 'woocommerce')
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id' => 'address',
                    'label' => __('Address', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the address for this product.', 'woocommerce')
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id' => 'email',
                    'label' => __('Email Address', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the email for this product.', 'woocommerce')
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id' => 'phone',
                    'label' => __('Phone No.', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the Phone No. for this product.', 'woocommerce')
                )
            );
            woocommerce_wp_text_input(
                array(
                    'id' => 'tender_expiry',
                    'label' => __('Tende Expiry.', 'woocommerce'),
                    'placeholder' => '',
                    'desc_tip' => 'true',
                    'description' => __('Enter the expiry for this product.', 'woocommerce')
                )
            );

        }

        // Save custom fields data for product
        // add_action('woocommerce_process_product_meta', 'save_custom_product_fields');
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

        // Create product in WooCommerce
        $new_product = wc_create_product($product);
        if (is_wp_error($new_product)) {
            // Handle error
            continue;
        }

        // Save custom fields data for product
        update_post_meta($new_product, 'bdr', sanitize_text_field($tender['BDR_No']));
        update_post_meta($new_product, 'tender_no', sanitize_text_field($tender['Tender_No']));
        update_post_meta($new_product, 'purchase_authority', sanitize_text_field($tender['Purchasing_Authority']));
        update_post_meta($new_product, 'competition_type', sanitize_text_field($tender['CompetitionType']));
        update_post_meta($new_product, 'category', sanitize_text_field($tender['Tender_Category']));
        update_post_meta($new_product, 'funding', sanitize_text_field($tender['Funding']));
        update_post_meta($new_product, 'address', sanitize_text_field($tender['Geographical_Addresses']));
        update_post_meta($new_product, 'email', sanitize_text_field($tender['Email_Address']));
        update_post_meta($new_product, 'phone', sanitize_text_field($tender['Mobile_Contacts']));
        update_post_meta($new_product, 'tender_expiry', sanitize_text_field($tender['Tender_Expiry']));

    }



    // $products = array();

    // foreach ($data as $item) {
    //     $product = array(
    //         'name' => $item['name'],
    //         'description' => $item['description'],
    //         'regular_price' => $item['price'],
    //     );
    //     $products[] = $product;
    // }

    // foreach ($products as $product) {
    //     $new_product = wc_create_product($product);
    //     if (is_wp_error($new_product)) {
    //         // Handle error
    //         continue;
    //     }
    // }






}



add_action('admin_init', 'my_function');

?>