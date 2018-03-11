# Secure WordPress REST API Access

Contributors: emanuelpoletto
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=E2PPPP9SPTF9E
Tags: secure, security, rest, api, access, json, restrict
Requires at least: 4.7
Tested up to: 4.9.4
Requires PHP: 5.2.4
Stable tag: 0.2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Require authentication for accessing the WordPress REST API to improve security.

## Description

This is a plugin for WordPress that filters any access to the WP REST API of your install and requires the user to be logged in before processing the request.

Only users with a role greater than subscriber are allowed to access the WP REST API. That's because a subscriber is considered just a registered visitor in most cases.

---

Besides, you can generate a token in order to allow GET only access to your WP REST API to anybody who passes that token as a URL parameter.

Log in to your dashboard as admin (or superadmin, if you are running a multisite network) and then access any page of your site adding the parameter below:

`https://yourdomain.com/?swpra_token_gen`

Just keep in mind that every time you create a new token it overrides the previous one. So, copy that to a safe place.

Inform that token in the URL when you want to GET your data through WP REST API as below:

`https://yourdomain.com/wp-json/wp/v2/posts/?swpra_token=YOUR_TOKEN_HERE`

Use the endpoint you want, of course.

If this plugin helped you somehow, remember to [leave some stars and optionally a review here](https://wordpress.org/support/plugin/secure-wp-rest-api-access/reviews/) ;)

And if you've found a bug or are having some problems with it, I'll be glad to help you, mainly in the [Support Forum](https://wordpress.org/support/plugin/hide-post/).

## Installation

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/secure-wp-rest-api-access` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.

## Changelog

### 0.2.0
* First release.