BOOTSTRAP FOR DRUPAL
============

1. FEATURES
2. BETTER ADMINISTRATION
3. SUGGESTED MODULES
4. CUSTOMIZING
5. **DISTRIBUTION**
6. REQUIREMENTS


This project aims to provide a pragmatic Drupal theme fully integrated
into [Bootstrap 4][9]. This theme aims to provide users with **the best
possible experience out of the box**, right after Drupal installation:
All native Drupal blocks and menus are placed and stylized along with
all native pages and forms. It also intended to be a **Bootstrap 4 base
solution** for developers with SCSS files provided.

This theme provides an advanced main navigation for desktop and mobile with a dynamic search bar.

This theme is created by [OCTOGONE.DEV](http://www.octogone.dev)

[![Support us by offering a coffee](https://store.octogone.dev/sites/default/files/image/content/offer-coffee.png)][8]

[![Demo](https://store.octogone.dev/sites/default/files/image/content/demo-bfd-bd.png)][7]


Desktop Menu            |  Mobile menu
:-------------------------:|:-------------------------:
![Desktop Menu](https://bootstrap-for-drupal.octogone.dev/sites/default/files/bootstrap-for-drupal-menu-desktop.gif "Animated dropdown") | ![mobile menu](https://bootstrap-for-drupal.octogone.dev/sites/default/files/bootstrap-for-drupal-menu-mobile.gif "Mobile menu")


![Desktop](https://bootstrap-for-drupal.octogone.dev/sites/default/files/screenshot-bfd.jpg "screenshot")


FEATURES
======

## ADVANCED NAVIGATION
 * Sticky navbar with dynamic search bar- Admin Toolbar compatible
 * Responsive branding header with Logo, slogan and site name
 * Responsive footer and sub footer each with three regions
 * A side column sticky
 * Language menu with flag (fr, en, es, de, nl, it, pt-pt, pt-br, ru)
 * Comments [Demo][12], Books are stylized [Demo][2] and forums are stylized [Demo][1] and are responsive
 * All forms are stylized
 * Print version

The theme is entirely built with the Bootstrap grid system and maximum usage of bootstrap classes.
List of Bootstrap components integrated : status message, pager, breadcrumbs, tooltips, popover, modal, carousel, form (custom style) : submit, input, checkbox, select, radio, textfield.

## LIST OF CONTACT TYPES (MAIL, PHONE, ETC..)
   The first footer region is configured to contain a **list of contact types**
   (mail, phone, etc..); it will automatically add the icons to a list (ul).
   You have the possibility to copy the code provided in the **HTML folder**,
   or to create a list yourself.

## SOCIAL ICON
   Social icon HTML code (svg) is provided in the **HTML folder**.

## BOOTSTRAP MODAL
   Modal code is available **HTML** folder. Copy the
   **modal box** code to a custom block that you create with full html text
   format, and place the created block in the **modal region**. Specify the page
   where it is displayed in the block settings, DO NOT display the title of the
   block. Finally, copy the **modal button code** in the corresponding page.


BETTER ADMINISTRATION
===============

The Adminimal suite of modules is the ultimate administration theming solution for Drupal. In ressources/css there is a **adminimal-custom.css** that match the color scheme of this theme. To use it, copy to the files folder and tick "Use adminimal-custom.css" in /admin/appearance/settings/adminimal_theme. This is a native feature of the Adminimal theme. List of modules to install: [Admin Toolbar][4], [Adminimal Admin Toolbar][5], [Adminimal theme][6]

SUGGESTED MODULES
============

## view counter - core module
To display the view counter on the public website, you have to activate the
**core** module statistics at `/admin/modules` and grant permission to
anonymous to **View content hits** at the page`/admin/people/permissions`.

## PATHAUTO

[pathauto](https://www.drupal.org/project/pathauto) will automatically
generate URL/path aliases for various kinds of content.
Below are the patterns to use for the different types of entities:

Content: article

`[node:content-type:name]/[node:title]`

Content: page

`[node:title]`

Content: Book

`book/[node:book:parents:join-path]/[node:title]`

Content: forum

`forum/[node:taxonomy_forums:entity:parents:join-path]/[node:taxonomy_forums:entity:name]/[node:title]`

Taxonomy

`[term:vocabulary]/[term:parents:join-path]/[term:name]`

Media

`media/[media:bundle]/[media:name]`

user

`user/[user:account-name]`

## FORM PLACEHOLDER
  [form_placeholder](https://www.drupal.org/project/form_placeholder)
  transforms forms labels into placeholders. It makes the form
  clearer and more user friendly.

  This is the list of IDs to add in the text area **Include text fields matching
  the pattern** of the config page
  `/admin/config/user-interface/form-placeholder`:
  ```
  #edit-mail
  #edit-message-0-value
  #edit-name
  #edit-subject-0-value
  #edit-pass
  #edit-comment-body-0-value
  ```
## HONEYPOT
  [honeypot](https://www.drupal.org/project/honeypot)
  protect your form from spam without punishing the user with a captcha.

## ALLOWED FORMATS
[allowed_formats](https://www.drupal.org/project/allowed_formats) allow for
the removal of the **text formats guidelines** below the forms.

CUSTOMIZING
============

In this theme there are tools for you to customize it with and whitout a subtheme. Note that this theme is designed to be stylized with SCSS, but there is a custom CSS available. [Gulp file is provided to compile SCCS files][10] and configured to be built with node.js at root of the theme.


If you are using a multisites Drupal instance with subtheme you have to copy
the "Bootstrap for Drupal" base theme to your site specific folder
`themes/contrib` or change the relative path in the SCSS master file -
`bfd_subtheme/assets/scss/style.scss`.

## WITH SUBTHEME

Copy the `resources/bfd_subtheme` folder to `/sites/themes/custom`  folder
and set it as default theme. Drupal.org provide
[documentation about sub-themes][11] and how to customize it.

### CSS
To use a custom CSS go to the theme settings in
`/admin/appearance/settings/bootstrap_for_drupal_subtheme` Tick
"Use bfd-custom.css". That setting will create a "bfd-custom.css" in files
folder that you can use to customize the theme.

### SCSS
After node.js configuration, you can theme directly with the file
`bfd_subtheme/assets/scss/base/_base.scss` and add SCSS files to the master
SCSS file `bfd_subtheme/assets/scss/tools/_subtheme.scss`.

## WITHOUT SUBTHEME

### CSS
To use a custom CSS go to the theme settings in
`/admin/appearance/settings/bootstrap_for_drupal` Tick "Use bfd-custom.css".
That setting will create a "bfd-custom.css" in files folder that you can use
to customize the theme.

### SCSS
In the theme, there is a SCSS template folder for you to add your custom CSS
without a subtheme. Find in `assets/scss/tools` a custom folder, copy it to
`assets/scss/` and in the bottom of the file `assets/scss/style.scss`
uncomment the line `@import custom/include`. **After updating the theme**
don't forget to uncomment that line again.


DISTRIBUTION
======

![Demo](https://www.drupal.org/files/logo-bfd-base-distribution.png)

[![Demo](https://store.octogone.dev/sites/default/files/image/content/discover-bfd-bd.png)][14]

Bootstrap for Drupal - BASE distribution is designed to ease the
**media publication** - video, audio, image, social media, document -
and the **media management** with a specific media library browser for
each media type. It is also designed to ease the integration of 
**Bootstrap dynamic presentation**.

## Components

Components are build with [paragraph][15] and [entity browser][16] thus no HTML
knowledge is required to publish them. All Medias are managed in the media
library.

**Media components**: HTML5 audio player, HTML5 video player, gallery
(Custom Bootstrap), social medias (Facebook, Instagram, Twitter), contents
(node/BS card), documents, links.

**Bootstrap components**: tabs, carousel, accordion, table, modal.
Popover and tooltips are HTML templates in CKEditor.

## Other features
Custom scrollspy block, custom scroll up/down button, Bootstrap [GDPR][13],
 HTML elements page. Examples content for every components.

## HTML5 player with playlist

Playlist with media description. Thumbnails for remote and local video - not
 all types. You can mix local and remote video in one video player. Keyboard
  control of volume and navigation. Several players can be integrated in the
   same page. Bulk upload.

**Video codecs/providers** : Youtube, Dailymotion, vimeo, mp4, ogg, webm.

**Audio codecs** : mp3, aac, ogg, flac.

![Demo](https://www.drupal.org/files/html5-player_0.jpg)

  [![Support us by offering a coffee](https://store.octogone.dev/sites/default/files/image/content/offer-coffee.png)][8]

REQUIREMENTS
======
No requirements.

[1]:https://bootstrap-for-drupal.octogone.dev/forum
[2]:https://bootstrap-for-drupal.octogone.dev/node/12
[3]:https://www.drupal.org/docs/8/administering-a-drupal-8-site/managing-content
[4]:https://www.drupal.org/project/admin_toolbar
[5]:https://www.drupal.org/project/adminimal_admin_toolbar
[6]:https://www.drupal.org/project/adminimal_theme
[7]:https://bootstrap-for-drupal.octogone.dev/
[8]:https://bootstrap-for-drupal.octogone.dev/node/185
[9]:https://getbootstrap.com/
[10]:https://medium.com/swlh/setting-up-gulp-4-0-2-for-bootstrap-sass-and-browsersync-7917f5f5d2c5
[11]:https://www.drupal.org/docs/theming-drupal/creating-sub-themes
[12]:[12]:https://bootstrap-for-drupal.octogone.dev/node/8#comments
[13]:https://www.drupal.org/project/eu_cookie_compliance
[14]:https://store.octogone.dev/product/bfd-base-distribution
[15]:https://www.drupal.org/project/paragraphs
[16]:https://www.drupal.org/project/entity_browser
