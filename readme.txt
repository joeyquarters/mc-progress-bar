=== Mc Progress Bar ===
Tags: mailchimp
Requires at least: 3.7
Tested up to: 4.7.5
Stable tag: 0.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Utilize the MailChimp API to create a progress bar for email signups.

== Description ==

Exposes a shortcode that allows users to create a progress bar within WordPress content. This progress bar will pull the member_count from the passed MailChimp list ID. A MailChimp API Key is *required* to use this plugin.

To use shortcode in its most basic form, enter this into your WordPress content:
```
[mc-progress-bar list_id="64ed1is84g" goal="5000"]
```

You may customize the words displayed in the progress bar by passing the following attributes:
```
[mc-progress-bar list_id="64ed1is84g" goal="5000" title="We're close!" signer_text="Users" goal_text="Target"]
```

There also exists a more "developer-friendly" shortcode that will just output the number of members within a list. It only requires a `list_id` attribute:
```
[mc-pb-count list_id="64ed1is84g"]
```

== Installation ==

Upload the plugin to your plugins folder in WordPress.

== Changelog ==

= 0.1.0 =
Initial Version
