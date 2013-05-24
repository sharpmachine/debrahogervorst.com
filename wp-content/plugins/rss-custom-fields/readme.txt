=== RSS Custom Fields ===
Contributors: rgubby
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=rgubby%40googlemail%2ecom&lc=GB&item_name=Richard%20Gubby%20%2d%20WordPress%20plugins&currency_code=GBP&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: rss, custom fields, custom fields in rss
Requires at least: 3.0
Tested up to: 3.0.3
Stable tag: 1.2.1

Allow your RSS feed to display custom tags

== Description ==

If you've ever wanted to use WordPress feeds to deliver content into other areas, and want to do it via custom fields, you'll know that WordPress feeds don't display custom fields.

With this plugin, you can show all your custom fields in your feed so you can pull data out of WordPress and use it with other systems. 

Custom fields are available inside a <custom_field> element in each <item>.

== Frequently Asked Questions ==

= Where are my custom fields in my RSS? =

If you have any custom fields on a post, you'll see a <custom_fields> element inside each <item>. Inside <custom_fields> will be all of your Custom Fields as a key value pair.

= Why don't I see any <custom_fields> elements? =

If you don't have any custom fields, you won't see them. Also, by default, any custom fields starting with an underscore are hidden. If you want to show them, try the Settings area and switching the option on to show hidden custom fields.

== Changelog ==

= 1.2.1 =
* Added compatibility with WordPress 3.0.3

= 1.2 =
* Changed admin location
* Added uninstall option

= 1.1 =
* Fixed CSS bug

= 1.0 =
* Added first version