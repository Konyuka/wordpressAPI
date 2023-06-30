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

    $body = wp_remote_retrieve_body($response);

    $data = json_decode($body->status);

    echo $data;
    return;


    // foreach ($data as $item) {
    //     $product_id = wp_insert_post(
    //         array(
    //             'post_title' => $item->name,
    //             'post_content' => '',
    //             'post_status' => 'publish',
    //             'post_type' => 'product'
    //         ));
    // }
}

add_action('admin_init', 'my_function');


// $response = wp_remote_get('https://www.biddetail.com/kenya/C62A8CB5DD405E768CAD792637AC0446/F4454993C1DE1AB1948A9D33364FA9CC');
// $body = wp_remote_retrieve_body($response);
// $data = json_decode($body);

// return dd($data);

// foreach ($data as $item) {
//     $product = new WC_Product_Simple();
//     $product->set_name($item->name);
//     $product->set_price($item->price);
//     $product->save();
// }

?>