<?php

add_filter('woocommerce_account_menu_item_classes', 'tpw_customize_woo_menu_items_classes', 10, 2);

function tpw_customize_woo_menu_items_classes($classes, $endpoint) {
    $classes[] = 'tpw-py-2';
    $classes[] = 'tpw-px-4';
    $classes[] = 'woo-dashboard-menu-item';

    return $classes;
}

