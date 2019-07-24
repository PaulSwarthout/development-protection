=== Development Protection ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: https://example.com/
Tags: comments, spam
Requires at least: 4.5
Tested up to: 5.2.2
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Plugin will block the WordPress plugins page from deleting plugins with a .git subfolder.

== Description ==

Have you ever clicked the delete link on the WordPress plugins page for a plugin that you're developing and watched as WordPress
nicely deleted your symlinked folder and all of your git history? If you're lucky enough to have a copy on GitHub or BitBucket,
you could just pull it down again, but still, you've just lost any and all changes that you've made since your last push.

The Development-Protection plugin helps solve that problem. It will remove the ability to 'Delete' a plugin from the WordPress plugins page
that has a .git sub-folder. It cannot detect that a particular folder is symlinked, but it can recognize that it's a development folder by the presence of the .git folder.

