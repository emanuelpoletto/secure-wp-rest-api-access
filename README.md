# Secure WordPress REST API Access

This is a plugin for WordPress that filters any access to the WP REST API of your install and requires the user to be logged in before processing the request.

Only users with a role greater than subscriber are allowed to access the WP REST API. That's because a subscriber is considered just a registered visitor in most cases.

---

Besides, you can generate a token in order to allow GET only access to your WP REST API to anybody who passes that token as a URL parameter.

Log in to your dashboard as admin (or superadmin, if you are running a multisite network) and then access any page of your site adding the parameter below:

`https://yourdomain.com/?swpra_token_gen`

Just keep in mind that every time you create a new token it overrides the previous one. So, copy that to a safe place.

Inform that token in the URL when you want to GET your data through WP REST API as below:

`https://yourdomain.com/wp-json/wp/v2/posts/?swpra_token=YOUR_TOKEN_HERE`

Use the endpoint you want, or course.

That's it! If you need further information or help or even found a bug, please, open an issue... I'll be glad to help you ;)