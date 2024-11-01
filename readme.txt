=== WP-AddonChat ===
Contributors: nickohrn
Tags: admin, chat, post, page, widget, template-tag
Requires at least: 2.9
Tested up to: 3.0.4
Stable tag: 2.0.0

WP-AddonChat provides an easy and quick way to integrate AddonInteractive's AddonChat software into your WordPress install.

== Description ==

Ready to integrate AddonInteractive's AddonChat software into your site?  Then this is the
plugin for you.  With the simple addition of an easy to remember shortcode, you can pop 
the chat room into your site in any page or post that you want.

In addition to integrating your chat room quickly and easily, you can add a way for site
visitors to see "Who's Chatting" in your chatroom.  For your convenience, the "Who's Chatting" functionality
is provided both as a widget and a standalone template tag.

== Installation ==

To install, simply unzip the download provided and follow the following steps:

1. Place the plugin into your `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plugin through the 'Settings > AddonChat' menu

To start, you need to have signed up for an AddonChat account.  If you haven't, then sign up for
one through the settings menu in the WordPress interface.  It's that easy!

After signing up for your AddonChat account, you only have a few short steps left.  First, 
you can add the chat applet within any post or page simply by including the 
specified shortcode [addonchat].  At the write post or write page interface, enter any content 
that you want.  Then, where you want the chat applet to appear, simply add the text [addonchat].

If you have a Professional PLUS or Enterprise edition account, you can enable Remote Authentication.  Check
the "Remote Authentication System" checkbox, and your users will be able to login using their WordPress username
and password.  If you want to allow guests, simply check the "Enable Guest Access" checkbox on the settings page.

The other major component of WP-AddonChat is the "Who's Chatting" widget.  As with all other widgets,
you enable the "Who's Chatting" widget by going to 'Appearance > Widgets' and dragging the "Who's Chatting" widget to 
the desired sidebar.  After placing it in a sidebar you can configure it.

If you don't want to add the widget through the WP interface, a template tag is provided that allows you
to show the current members of your chat room at any time.  The tag is `addonchat_whos_chatting` and it echos
a simple unordered list, with each list item containing the user name of a currently active chat member.

To uninstall the plugin, please perform the following steps.

1. Deactivate the plugin through the 'Plugins' menu in WordPress
1. If desired, remove the plugin directory from your `/wp-content/plugins/` directory
