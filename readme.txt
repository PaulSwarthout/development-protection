=== Development Protection ===
Contributors: paulswarthout
Donate link: https://www.paypal.me/PaulSwarthout
Tags: Protect, development, WordPress, symlink, ln, mklink
Requires at least: 4.5
Tested up to: 5.2.2
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Plugin will block the WordPress plugins page from deleting plugins with a .git subfolder.

== Description ==

The WordPress Installed Plugins page on your dashboard is a really handy tool for installing, activating, deactivating,
and finally deleting and removing all traces of a plugin from your WordPress installation.
However, if you are like me, you might use a symbolic link (ln in Linux or mklink in Windows)
to your plugin development folder in the /wp-content/plugins folder. This lets you make changes to your plugin code
and test those changes immediately.

Unfortunately, when it comes time to test your plugin's activate, deactivate, and uninstall functionality,
you might forget that your plugin folder in your WordPress test environment is symbolically linked to
your development folder -- even for just a few minutes.

You can activate and deactivate your development plugin as often as you wish with no harm to your development folder.
But the moment you tap the 'Delete' option, after deactivating, WordPress will nicely delete the plugin folder
and all of its files and subfolders, as it was designed to do.

Unfortunately, if that plugin folder was symbolically linked to your development folder,
then WordPress will have just deleted your development folder and all of its files, subfolders,
including your git repository ('.git' subfolder). You will have just lost all of the changes that you have made to your plugin
since your last push to your favorite central repository like GitHub or BitBucket.



This simple little plugin for WordPress will help you to avoid that scenario by eliminating the
'Delete' option for any deactivated plugin that has a '.git' subfolder.



There is no way to detect that any given folder is a symbolically linked folder, but if you have a .git subfolder,
then most likely it is a development folder that you would like to prevent WordPress from automatically deleting.
If you do not have a .git subfolder, then you could modify lines 54 and 56 to look for something that you do have.

I have accidentally deleted my development folder more than once. It's not a good feeling. Now I don't have to worry about it.
And if you install and activate this plugin in any WordPress installation where you symbolically link your
plugin development folder, you won't have to worry about it, either.

