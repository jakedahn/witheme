=== WP-Gravatar ===
Contributors: Rune_Gulbrandsoy
Donate link: http://www.amazon.com/gp/registry/wishlist/1K51U8VX047NY
Tags: gravatars, comments, widgets, profile, favico, favatar, MyBlogLog, OpenAvatar, Wavatar, Identicon, monsterID
Requires at least: 2.1
<<<<<<< .mine
Tested up to: 2.6
=======
Tested up to: 2.5.1
>>>>>>> .r54862
Stable tag: trunk

Gives your users Gravatars, MyBlogLog and/or OpenAvatar avatars. Please use http://gravatar.bloggs.be for more information, feedback and questions! Thanks.<br/>
If you use WordPress MU, there is also a version for that!

== Description ==
This plugin lets you use Gravatar, MyBlogLog, OpenAvatar, Wavatar, Identicon, monsterID or Favico.ico files with your comments. But thats not all, scroll down to see what else this plugin does for your site.
The plugin has been tested on version 2.1, 2.2, 2.3.1, 2.3.2, 2.3.3 and 2.5. Should work on all versions from 2.1 and upwards. It will also detect the Prologue theme 
from Automattic. 

This plugin does:

* Gravatar, MyBlogLog, OpenAvatar, Wavatar, Identicon, monsterID with the comments section
* Let's you set your own CSS style to use with the Comments section and the author about box.
* Gives you a Widget with your profile info and your gravatar
* Use an Author Profile box in the sidebar if your theme does not support Widgets.
* Gives you your Gravatar with every blog post (always top left of post in 20px*20px)
* Gives you the option to show an <em>about the author box</em> with posts shown on single page
* Makes Gravatars from users with no blog/url link back to your own site.
* Lets you set a default gravatar to use on your site for users that don't have a gravatar
* Recent Comments Widget that shows Gravatar, OpenAvatar, Wavatar, Identicon, monsterID (in 20px*20px not changeable by user)
* Makes use of favicon.ico of the users site, if the user don't have a Gravatar.
* Let's you show the Gravatar, OpenAvatar, Wavatar, Identicon, monsterID avatars in the <strong>Edit Comment</strong> section of your admin pages.
* Let's you set the size of the Gravatar, OpenAvatar, Wavatar, Identicon, monsterID and MyBlogLog avatars


== Changelog ==

2.0 First public release<br/>
2.1 Added one option, fixed typos and changed alignment of img<br/>
2.1.1 fixed minor bugs from 2.1<br/>
2.2 Added widget to show the recent comments with Gravatars. Can show from 1 to 15 comments (default 5)<br/>
2.3 Added the use of Favicons. If the users homepage or blog has a favico.ico file, this will be used instead of the default Gravatar.<br/>
2.3.1 Made the plugin compatible with WP from version 2.1 (needs the Widget Plugin) and upwards<br/>
2.3.2 Implemented lowecasing of email adresses, as requested by Piergiorgio :-) <br/>
2.4 Implemented the use of MyBlogLog Avatars. The use of this function will override your sites default Gravatar withe the default Avatar of MyBlogLog. Hopefully this issue will be resolved in a later update. Also changed the option to link Gravatar/MyBlogLog to commenters site/your own site.<br/>
2.5 Implemented a function for users with themes that does not support Widgets. Those users can now place a function in their sidebar.php to get a Author Profile box. Added the option to use <em>nofollow</em> on commenters site link. Also tried to make the Admin interface better and more userfriendly.<br/>
2.5.1 Added the option to exclude Gravatars from Wordpress pages (eg. <em>About</em> etc.)<br/>
2.5.2 Added the option to show Gravatars/MyBlogLog avatars in the Edit Comment section of your admin pages.<br/>
2.6 Added <em>about the author box</em> option, option to change the size of the Gravatars and MyBlogLog avatars and an option to give in your footer some kudos to this plugin<br/>
2.6.1 Added the option to use your own CSS<br/>
2.6.2 Added the Gravatars <em>rating</em> option.<br/>
2.6.3 All Gravatars respects the size option set by the user, except for the Recent Comments widget. Added support to use a <em>modified</em> version of Automattics Prologue Theme.<br/>
2.6.4 Made the plugin aware of Automattics Prologue Theme, and turnes of the functions/options that have no effect on this theme, leaving you with the options you <em>can</em> use with this theme.<br/>
2.6.5 Added version check, to determin the version of WP. Made the plugin work with WP 2.5. Added the OpenAvatar function. Moved the Plugin page to top level in 2.5+.<br/>
2.7 Added the use of Wavatar, Identicon, monsterID, now also in the recent comments widget.<br/>
2.7.1 Fixed some problems with OpenAvatar. OpenAvatar now also in Widget<br/>
== Installation ==

How to use WP-Gravatars:

1. Upload `gravatars.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the Presentation menu to change your settings.
4. Set your default gravatar
5. If you want to use the Profile Widget, you HAVE to set the USER ID and choose to use the widget, before placing the widget in the sidebar! If you don't do this, you will most likely get an mySQL error!

== Frequently Asked Questions ==

Use <a href="http://gravatar.bloggs.be/">plugin support forum</a> for suport.

== Screenshots ==

1. The Dashbord part of the plugin.
2. The <em>about the author box</em> in posts
3. The Recent comments with Gravatar widget