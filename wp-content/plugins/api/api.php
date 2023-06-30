<?php
include('wp-load.php');

$response = wp_remote_get('https://www.biddetail.com/kenya/C62A8CB5DD405E768CAD792637AC0446/F4454993C1DE1AB1948A9D33364FA9CC');
$body = wp_remote_retrieve_body($response);
$data = json_decode($body);

foreach ($data as $item) {
    $product = new WC_Product_Simple();
    $product->set_name($item->name);
    $product->set_price($item->price);
    $product->save();
}

?>