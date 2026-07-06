=== Random Quote - Daily Inspirational Quotes for WordPress ===
Contributors: wppure, huzaifaalmesbah
Tags: random quote, quote, shortcode
Requires at least: 5.6
Tested up to: 6.7
Requires PHP: 7.0
Stable tag: 1.1.0
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Enhance your WordPress site with beautiful, daily-refreshing inspirational quotes. Easy integration via Gutenberg block or shortcode.

== Description ==

Random Quote is a powerful yet lightweight WordPress plugin that brings daily inspiration to your website through carefully curated quotes from the ZenQuotes API. Perfect for blogs, business websites, or any platform seeking to engage visitors with meaningful content.

= Key Features =

* **Daily Fresh Quotes** - Automatically fetches and displays new inspirational quotes every 24 hours
* **Multiple Integration Options**:
    * Modern Gutenberg Block for visual integration
    * Classic [wpprq_quote] shortcode support

* **Performance Optimized**:
    * Smart 24-hour quote caching
    * Minimal API requests
    * Lightweight and fast loading

== Installation ==

= Via WordPress Repository (Recommended): =
1. Log in to your WordPress Dashboard
2. Navigate to Plugins > Add New
3. Search for "Random Quote"
4. Click "Install Now" and wait for the installation to complete
5. Click "Activate" to enable the plugin
6. Start using the plugin by adding the Gutenberg block or shortcode

= Manual Installation: =
1. Download the plugin zip file from WordPress.org
2. Log in to your WordPress Dashboard
3. Navigate to Plugins > Add New > Upload Plugin
4. Choose the downloaded zip file and click "Install Now"
5. After installation, click "Activate"
6. Begin using the plugin's features

= How to Use =
**Using Gutenberg Block (Recommended):**
1. Create or edit a post/page
2. Click the '+' button to add a new block
3. Search for "Random Quote"
4. Select the Random Quote block
5. The quote will automatically appear in the editor
6. Customize the appearance using block settings

**Using Shortcode:**
1. Edit any post, page, or widget
2. Add the shortcode [wpprq_quote] where you want the quote to appear
3. Save your changes
4. The quote will be displayed on your page

== Check out our other Plugins ==

Enhance your WordPress site with our other powerful plugins:

- **[Smart Password Protect](https://wordpress.org/plugins/smart-password-protect/)** - Secure your WordPress site with password protection and IP whitelisting.
- **[Redirect After Logout](https://wordpress.org/plugins/redirect-after-logout/)** - Redirect users to a custom page after logging out for enhanced user experience.
- **[Access Defender](https://wordpress.org/plugins/access-defender/)** - Advanced security plugin to protect your WordPress site from unauthorized access and malicious attacks.
- **[Contributors Gallery](https://wordpress.org/plugins/contributors-gallery/)** - Showcase your WordPress contributors in a beautiful and customizable gallery layout.
- **[Product Spotlight Badge](https://wordpress.org/plugins/product-spotlight-badge/)** - Highlight your WooCommerce products with eye-catching badges to boost sales.

Visit [our plugin collection](https://profiles.wordpress.org/huzaifaalmesbah/#content-plugins) to explore more.

**Please Note:** This plugin relies on the ZenQuotes API to fetch the daily quotes. By using this plugin, you agree to the [ZenQuotes API Terms and Conditions](https://docs.zenquotes.io/terms-and-conditions/) and [Privacy Policy](https://docs.zenquotes.io/privacy-policy/). Your website will send a request to the ZenQuotes API to retrieve a quote, and the API's servers may log certain data such as IP addresses as part of their normal operations.

== Privacy Policy ==
Random Quote uses [Appsero](https://appsero.com) SDK to collect some telemetry data upon user's confirmation. This helps us to troubleshoot problems faster & make product improvements.

Appsero SDK **does not gather any data by default.** The SDK only starts gathering basic telemetry data **when a user allows it via the admin notice**. We collect the data to ensure a great user experience for all our users. 

Integrating Appsero SDK **DOES NOT IMMEDIATELY** start gathering data, **without confirmation from users in any case.**

Learn more about how [Appsero collects and uses this data](https://appsero.com/privacy-policy/).

== Frequently Asked Questions ==

= How often does the quote update? =
The plugin fetches a new quote daily from the ZenQuotes API. The quote is cached for 24 hours to optimize performance and reduce API calls.

= Can I customize the quote's appearance? =
Yes! The Gutenberg block provides basic styling options. For advanced customization, you can use custom CSS to style the quote container.

= Does the plugin work with page builders? =
Yes, you can use the shortcode [wpprq_quote] with any page builder that supports shortcodes.

= Does the plugin store any user data? =
The plugin itself does not store any user data. However, when fetching a quote from the ZenQuotes API, certain data such as IP addresses may be logged by the API provider.

= Is the plugin GDPR compliant? =
Yes, the plugin is GDPR compliant. It only processes the minimum data necessary for functionality and clearly discloses any data collection through Appsero SDK (which is opt-in only).

== Changelog ==
= 1.1.1 =
* Enhanced error handling with specific error messages (connection, HTTP, JSON, data errors)
* Added fallback mechanism to display last successful quote during API failures
* Implemented admin notifications for API connection and service errors
* Added debug logging for API requests when WP_DEBUG is enabled
* Improved transient handling and caching strategies
* Enhanced timeout and redirection settings for API requests
* Fixed "Could not retrieve quote" persistence issues

= 1.1.0 =
* Added Gutenberg block support for easier quote integration
* Improved code organization with PSR-4 autoloading
* Optimized API calls with 24-hour quote caching
* Enhanced performance by minimizing API requests

= 1.0.2 =
* Added integration with AppSero for tracking plugin usage and updates.

= 1.0.1 =
* Update Description.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.1.0 =
* Major update with Gutenberg block support and performance improvements.

= 1.0.0 =
* Initial release.

== Screenshots ==

1. Screenshot of the daily inspirational quote displayed on a website.
2. Gutenberg block interface for easy quote integration.
3. Example of the quote display in different themes.

== API Credits ==

The plugin uses the ZenQuotes API (https://zenquotes.io/) to fetch daily inspirational quotes.

== License ==

This plugin is licensed under the GNU General Public License v2 or later.
