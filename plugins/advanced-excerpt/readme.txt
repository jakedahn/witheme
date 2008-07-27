=== Advanced Excerpt ===
Contributors: basvd
Tags: excerpt, advanced, post, formatting
Requires at least: 2.2
Tested up to: 2.5.1
Stable tag: trunk

Several improvements over WP's default excerpt. The size of the excerpt can be limited using character or word count, and HTML markup is not removed.

== Description ==

This plugin adds several improvements to WordPress' default way of creating excerpts.

1. It can keep HTML markup in the excerpt (and you get to choose which tags are included)
2. It trims the excerpt to a given length using either character count or word count
3. You can customise the excerpt length and the ellipsis character that will be used when trimming
4. The excerpt length is *real* (ie. "words" and characters belonging to HTML tags are not counted)

In addition to keeping HTML markup in the excerpt, the plugin also corrects HTML that might have been broken due to the trimming process.

== Installation ==

After you've downloaded and extracted the files:

1. Upload the complete `advanced-excerpt` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to 'Excerpt' under the 'Options' tab and configure the plugin


== Frequently Asked Questions ==

= Why do I need this plugin? =

The default excerpt created by WordPress removes all HTML. If your theme uses `the_excerpt()` to view excerpts, they might look weird because of this (e.g. smilies are removed, lists are flattened, etc.) This plugin fixes that and also gives you more control over excerpts.

= Does it work for WordPress version x.x.x? =

I haven't had the chance to test the plugin on many versions of WordPress. It has been tested on 2.2 through 2.5.1, but it might work on other versions, too. You can safely try it yourself, because the plugin is unlikely to break anything (it's only an output filter). Please let me know if you succesfully tested it on another version of WordPress.

= Can I manually call the filter in my WP templates, for example? =

The plugin automatically hooks on `the_excerpt()` function and uses the parameters specified in the options panel. You can also call it manually and specify custom parameters. This can be useful for theme developers.
The following code is used to call the plugin's filter function:

`$advancedexcerpt->filter($text, $length, $use_words, $ellipsis, $allowed_tags)`

* `$text` is the full text of whatever you need an excerpt of.
* `$length` is an integer specifying the length of the excerpt.
* `$use_words`, when `1` tells the filter to count words instead of characters.
* `$ellipsis` is a string which is appended to the excerpt. Use [HTML entities]( http://www.w3schools.com/tags/ref_entities.asp) for special characters.
* `$allowed_tags` is an array of tags that are kept in the excerpt, for example `array('a', 'strong', 'div')`

Passing `null` to any of these parameters (except for the first) results in the default value being used instead. This way you can change the ellipsis without changing the length, for example.
