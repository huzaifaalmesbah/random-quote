=== Random Quote ===
Contributors: wppure, huzaifaalmesbah
Tags: random quote, quote, shortcode
Requires at least: 5.6
Tested up to: 6.6.2
Requires PHP: 7.0
Stable tag: 1.0.6
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A simple plugin that displays a daily inspirational quote using the ZenQuotes API.

== Description ==

Random Quote is a lightweight plugin that fetches a random daily inspirational quote from the ZenQuotes API and displays it on your website. Simply use the [wpprq_quote] shortcode to embed the quote wherever you want.

Features:
- Automatically fetches and displays a new quote daily.
- Uses a simple shortcode for easy embedding.

**Please Note:** This plugin relies on the ZenQuotes API to fetch the daily quotes. By using this plugin, you agree to the [ZenQuotes API Terms and Conditions](https://docs.zenquotes.io/terms-and-conditions/) and [Privacy Policy](https://docs.zenquotes.io/privacy-policy/). Your website will send a request to the ZenQuotes API to retrieve a quote, and the API's servers may log certain data such as IP addresses as part of their normal operations.

## Privacy Policy 
Random Quote uses [Appsero](https://appsero.com) SDK to collect some telemetry data upon user's confirmation. This helps us to troubleshoot problems faster & make product improvements.

Appsero SDK **does not gather any data by default.** The SDK only starts gathering basic telemetry data **when a user allows it via the admin notice**. We collect the data to ensure a great user experience for all our users. 

Integrating Appsero SDK **DOES NOT IMMEDIATELY** start gathering data, **without confirmation from users in any case.**

Learn more about how [Appsero collects and uses this data](https://appsero.com/privacy-policy/).
== Installation ==

1. Upload the `random-quote` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Use the shortcode `[wpprq_quote]` in any post, page, or widget to display the daily inspirational quote.

== Frequently Asked Questions ==

= How often does the quote update? =

The plugin fetches a new quote daily from the ZenQuotes API.

= Does the plugin store any user data? =

The plugin itself does not store any user data. However, when fetching a quote from the ZenQuotes API, certain data such as IP addresses may be logged by the API provider.

== Changelog ==
= 1.0.2 =
* Added integration with AppSero for tracking plugin usage and updates.

= 1.0.1 =
* Update Description.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
* Initial release.

== Screenshots ==

1. Screenshot of the daily inspirational quote displayed on a website.

== API Credits ==

The plugin uses the ZenQuotes API (https://zenquotes.io/) to fetch daily inspirational quotes.

== License ==

This plugin is licensed under the GNU General Public License v2 or later.
