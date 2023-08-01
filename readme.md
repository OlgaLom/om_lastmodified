## Custom XML Plugin for WordPress WooCommerce Products

The "Last 10 Minutes Products XML" is a custom WordPress plugin designed to generate an XML file containing information about products modified within the last 10 minutes in a WooCommerce store. The plugin creates an XML sitemap with product URLs and last modification dates.

## How to Install
To install the "Last 10 Minutes Products XML" plugin, follow these steps:

1. Download the Plugin: Download the plugin files from the provided source (e.g., GitHub repository) or as a ZIP file.

2. Upload the Plugin: Log in to your WordPress admin dashboard. Navigate to "Plugins" > "Add New" > "Upload Plugin." Select the plugin ZIP file and click "Install Now."

3. Activate the Plugin: After successful installation, click "Activate" to activate the "Last 10 Minutes Products XML" plugin.

<hr>

<strong>Schedule XML Generation: </strong>Upon activation, the plugin will automatically schedule the generation of the XML file. The XML generation event will run every hour.
<br><br>
<strong>XML File Location:</strong> The plugin will generate the XML file named "last_10_minutes_products.xml" in the "uploads/last_10_minutes_products/" directory within your WordPress installation's "wp-content" folder.
<br><br>
<strong>Customization:</strong> If you need to customize the XML structure or content, you can modify the generate_last_10_minutes_products_xml function within the plugin code. For example, you can add or remove product information from the XML.
<br><br>

That's it! 
