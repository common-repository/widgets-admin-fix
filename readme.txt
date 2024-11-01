=== Widgets Admin Fix ===
Contributors: Ptah Dunbar
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7881553
Tags: widgets, admin
Requires at least: 2.8
Tested up to: 2.9
Stable tag: 0.2

This plugin adds the ability to link to specific sidebars in the widgets admin page and have them open up automatically.

== Description ==

This plugin adds the ability to link to specific sidebars in the widgets admin page and have them open up automatically. In addition, by default when visiting the widgets admin page, none of the sidebars are open.

<pre>&lt;a href="&lt;?php echo admin_url( 'widgets.php' ) .'?sidebar=aside'; ?&gt;"&gt;Add Widgets&lt;/a&gt;</pre>
You'll need to know the IDs of the sidebars you'd like to have opened. For multiple sidebars, simply separate them with commas.
<pre>&lt;a href="&lt;?php echo admin_url( 'widgets.php' ) .'?sidebar=aside,body_open,before_the_loop'; ?&gt;"&gt;Add Widgets&lt;/a&gt;</pre>

Alternatively, you can use the <code>add_widgets_link()</code> function:
<pre>&lt;?php echo waf_widgets_link( 'aside', 'Add Widgets to Aside' ); ?&gt;
&lt;?php echo waf_widgets_link( 'aside,body_open,before_the_loop' ); ?&gt;</pre>

== Installation ==

1. Upload the 'widgets-admin-fix' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

**0.2**
	* CHANGED: function name from add_widgets_link() to waf_widgets_link()
	* UPDATED: readme.txt
	* ADDED: license.txt

**0.1**
	* Initial Release. (08/31/09)