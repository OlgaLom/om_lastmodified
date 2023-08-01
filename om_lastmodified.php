<?php
/**
 * Plugin Name: Last 10 Minutes Products XML
 * Description: Generates an XML file containing products modified within the last 10 minutes and updates the XML every hour.
 * Version: 1.0
 * Author: Moumtzi Olga
 */

// Schedule the XML generation on plugin activation
register_activation_hook(__FILE__, 'schedule_last_10_minutes_products_xml_generation');

// Function to schedule the XML generation every hour
function schedule_last_10_minutes_products_xml_generation() {
    if (!wp_next_scheduled('generate_last_10_minutes_products_xml_event')) {
        wp_schedule_event(time(), 'hourly', 'generate_last_10_minutes_products_xml_event');
    }
}

// Hook the function to generate the XML on the scheduled event.
add_action('generate_last_10_minutes_products_xml_event', 'generate_last_10_minutes_products_xml');

// Function to generate and save the XML file
function generate_last_10_minutes_products_xml() {
    $time_10_minutes_ago = strtotime('-10 minutes');

    $args = array(
        'post_type' => 'product', 
        'post_status' => 'publish',
        'date_query' => array(
            array(
                'column' => 'post_modified_gmt',
                'after' => date('Y-m-d H:i:s', $time_10_minutes_ago),                 
            ),
        ),
        'posts_per_page' => -1,
    );

    // Query products modified within the last 10 minutes
    $products_query = new WP_Query($args);

    // Prepare the XML content
    $xml_content = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    $xml_content .= '<products>';

    // Loop through the products and add them to the XML
    if ($products_query->have_posts()) {
        while ($products_query->have_posts()) {
            $products_query->the_post();          
            $product_link = get_permalink();

            // You can customize the XML structure based on your product data
            $xml_content .= '<url>';
            $xml_content .= '<link>' . $product_link . '</link>';
            $xml_content .= '<lastmod> '. $products_query->get_date_modified()->date('d m Y') . ' </lastmod>';
            $xml_content .= '</url>';
        }
    }

    $xml_content .= '</products>';
    $xml_content .= '</urlset>';
    // Restore original post data
    wp_reset_postdata();

    // Generate a filename for the XML
    $file_name = 'last_10_minutes_products.xml';

    // Define the XML directory path
    $xml_directory = WP_CONTENT_DIR . '/uploads/last_10_minutes_products/';

    // Create the directory if it doesn't exist
    if (!file_exists($xml_directory)) {
        mkdir($xml_directory);
    }

    // Save the XML file
    $xml_file_path = $xml_directory . $file_name;
    file_put_contents($xml_file_path, $xml_content);

}
