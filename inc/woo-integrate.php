<?php
function create_or_update_course_woocommerce_product($post_id) {
    if (get_post_type($post_id) != 'course') {
        return;
    }

    $price = get_post_meta($post_id, 'tpw_course_price', true);
    if (!$price) {
        return;
    }

    // Check if a WooCommerce product already exists for this course
    $product_id = get_post_meta($post_id, '_course_product_id', true);
    
    if ($product_id) {
        // Product exists, update it
        $product = wc_get_product($product_id);
        if ($product) {
            $product->set_name(get_the_title($post_id));
            $product->set_regular_price($price);
            $product->save();
        }

        // Save the product ID in the course meta
        update_post_meta($post_id, '_course_product_id', $product->get_id());

        // Save the associated course ID in the product meta
        update_post_meta($product->get_id(), '_associated_course_id', $post_id);
    } else {
        // Product does not exist, create a new one
        $product = new WC_Product_Simple();
        $product->set_name(get_the_title($post_id));
        $product->set_regular_price($price);
        $product->set_status('publish');
        $product->save();

        // Save the product ID in the course meta
        update_post_meta($post_id, '_course_product_id', $product->get_id());

        // Save the associated course ID in the product meta
        update_post_meta($product->get_id(), '_associated_course_id', $post_id);
    }
}
add_action('save_post', 'create_or_update_course_woocommerce_product');

function restrict_course_content() {
    if (is_singular('courses')) {
        $product_id = get_post_meta(get_the_ID(), '_course_product_id', true);
        if ($product_id) {
            if (!wc_customer_bought_product('', get_current_user_id(), $product_id)) {
                wp_redirect(home_url('/cart'));
                exit;
            }
        }
    }
}
add_action('template_redirect', 'restrict_course_content');

// Add custom menu item to WooCommerce My Account menu
function add_courses_my_account_menu_item( $items ) {
    // Rearrange the menu items and add the new item after "Dashboard"
    $new_items = array();
    foreach ( $items as $key => $value ) {
        $new_items[ $key ] = $value;
        if ( $key === 'dashboard' ) {
            $new_items['courses'] = __( 'Courses', TEXTDOMAIN );
        }
    }
    return $new_items;
}
add_filter( 'woocommerce_account_menu_items', 'add_courses_my_account_menu_item' );

// Add custom endpoint for the new menu item
function add_courses_endpoint() {
    add_rewrite_endpoint( 'courses', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'add_courses_endpoint' );

// Display content for the custom menu item
function courses_endpoint_content() {
    $user_id = get_current_user_id();
    
    if ( ! $user_id ) {
        echo '<p>' . __( 'Please log in to view your purchased courses.', TEXTDOMAIN ) . '</p>';
        return;
    }
    
    // Get all orders for the user
    $args = array(
        'customer' => $user_id,
        'status'   => array('completed', 'processing'),
    );
    
    $orders = wc_get_orders($args);
    
    if ( empty($orders) ) {
        echo '<p>' . __( 'You have not purchased any courses yet.', TEXTDOMAIN ) . '</p>';
        return;
    }
    
    $purchased_courses = array();
    
    foreach ( $orders as $order ) {
        foreach ( $order->get_items() as $item_id => $item ) {
            $product_id = $item->get_product_id();
            
            // Ensure this is a WooCommerce product
            if ( get_post_type( $product_id ) === 'product' ) {
                $associated_course_id = get_post_meta($product_id, '_associated_course_id', true);
                
                if ( $associated_course_id && get_post_type( $associated_course_id ) === 'course' ) {
                    $purchased_courses[] = $associated_course_id;
                }
            }
        }
    }
    
    if ( ! empty( $purchased_courses ) ) {
        echo '<div class="tpw-container mx-auto px-4 py-8">';
            echo '<h2 class="tpw-text-2xl tpw-font-bold mb-6">' . __( 'Your Purchased Courses', TEXTDOMAIN ) . '</h2>';
                echo '<div class="tpw-grid tpw-grid-cols-1 sm:tpw-grid-cols-2 lg:tpw-grid-cols-3 gap-6">';
                    foreach ( $purchased_courses as $course ) {
                        $thumbnail_url = get_the_post_thumbnail_url($course);
                        $thumbnail_alt = get_post_meta ( get_post_thumbnail_id($course), '_wp_attachment_image_alt', true );

                        echo '<div class="tpw-bg-white tpw-shadow-md tpw-rounded-lg tpw-overflow-hidden">';
                            echo '<img src="' . $thumbnail_url . '" alt="' . $thumbnail_alt . '" class="tpw-w-full tpw-h-48 tpw-object-cover">';
                            echo '<div class="tpw-p-4">';
                                echo '<h3 class="tpw-text-xl tpw-font-semibold mb-2">' . __( get_the_title($course), TEXTDOMAIN ) . '</h3>';
                                echo '<a href="' . get_permalink($course) . '" class="tpw-text-blue-500 tpw-hover:underline">View Course</a>';
                            echo '</div>
                        </div>';
                    } echo '
                </div>
            </div>';
    } else {
        echo '<p>' . __( 'You have not purchased any courses yet.', TEXTDOMAIN ) . '</p>';
    }
}
add_action( 'woocommerce_account_courses_endpoint', 'courses_endpoint_content' );

// Flush rewrite rules on plugin activation
function courses_rewrite_flush() {
    add_courses_endpoint();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'courses_rewrite_flush' );

// Flush rewrite rules on plugin deactivation
function courses_rewrite_flush_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'courses_rewrite_flush_deactivate' );