# Fill It Up (for WordPress) [v1.0.3]
Fill It Up for WordPress is a handy free plugin to mass generate content & users in WordPress.

You have the choice of easily creating your own set of re-usable dummy content (essentially made up of sets of images, links and embedded media) or you can use third-party sets, curated by other users.

By using Fill It Up you speed up the initial development process until actual, proper content is in place.

It's that simple. Really :)

That's why it took only a few minutes to set up this demo site: https://demo.joomlaworks.net/wp/


## Screenshots
![Fill It Up v1.x - Preview](https://cdn.jsdelivr.net/gh/kodeka/kdk_fill_it_up@master/admin/assets/images/kdk_fill_it_up_preview_20200122.png)


## Why?
Custom dummy content should not be hard to make. Unlike other solutions, you get to create your own set of dummy content and re-use them as you want.

It's what we like to call "curated sample data sets"!

In the future, we plan to release pre-built sets of definition files from other users, covering different types of dummy content (e.g. news, blog posts, politics, cars, design, fashion etc.) for anyone to re-use and get from prototyping to a production ready WordPress site in hours, not days!


## Use it
1. Get the latest build, ready to upload to WordPress: # (please DO NOT use the repo "master" zip file as it cannot be directly installed on WordPress)
2. Edit the plugin's Settings and add this demo definition file:
   - If you already use HTTPS: https://cdn.joomlaworks.org/fillitup/demo/900x600.json
   - If you get any issues related to SSL (especially while testing Fill It Up locally), use this URL instead: http://cdn.joomlaworks.org/fillitup/demo/900x600_plain_http.json
3. Go back to the plugin and hit "Generate content & users"
4. Adjust your settings and go!

Depending on the number of items you choose to generate, it will take from a few seconds to a few minutes to complete, so be patient. You'll see a success message when the process is complete.


## Create your own dummy content sets
Examine the structure of the demo definition file: https://cdn.joomlaworks.org/fillitup/demo/900x600.json

You'll notice that this file references some .zip files. These .zip files contain images which are fetched by Fill It Up and inserted in WordPress items in the category name specified in the same definition block. Additionally, per category block, you can pass one JavaScript array for videos (use links for video providers supported by WordPress using oEmbed, e.g. YouTube or Vimeo, or use entire embed snippets for others) and one JavaScript array for Flickr sets (albums) (use entire embed snippets). Now since the file has to be valid JSON, make sure you escape any double quotes (\") when inserting embed snippets into each array.


## Upgrading
Until we upload the plugin in the WordPress Plugins Directory, there are 2 ways to update Fill It Up in WordPress:

a) The easy way: use the awesome & free [Easy Theme and Plugin Upgrades](https://wordpress.org/plugins/easy-theme-and-plugin-upgrades/) plugin to be able to simply install any new version of Fill It Up on top of any existing one.

b) The old-fashioned way: use (S)FTP to connect to your WordPress site and then navigate to your plugins folder and simply remove the folder named "fillitup". Now extract on your PC the zip download with the new version and upload the entire "fillitup" folder on your WordPress site's plugins folder.


## License & Credits

Licensed under the GNU/GPL license (https://www.gnu.org/copyleft/gpl.html).

Copyright (c) 2018 - 2020 Kodeka OÜ. All rights reserved.
