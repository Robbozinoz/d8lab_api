CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------

The Block List Override module removes unnecessary blocks from the block list for better system performance.

 * For a full description of the module, visit the project page:
   https://drupal.org/project/block_list_override

 * To submit bug reports and feature suggestions, or to track changes:
   https://drupal.org/project/issues/block_list_override


REQUIREMENTS
------------

This module requires no modules outside of Drupal core.


INSTALLATION
------------

 * Install as you would normally install a contributed Drupal module. Visit:
   https://www.drupal.org/node/1897420 for further information.
 * If updating from the Block Blacklist module, leave Block Blacklist installed
   while installing this module. The installation will detect the Block
   Blacklist settings and copy them over. Confirm that the settings were copied
   correctly then uninstall and remove Block Blacklist.

CONFIGURATION
-------------

    1. Navigate to Administration > Extend and enable the module.
    2. Navigate to Administration > Configuration > System > Block List Override   Settings and list each name or value on a new line in the appropriate section. The user has the option to identify blocks to be removed or allowed by name or  prefix, or provide a regex for more complex matching options.
    3. Save.


MAINTAINERS
-----------

Current maintainers:
 * Karen Stevenson (KarenS) - https://www.drupal.org/u/karens

This project is sponsored by:
 * Lullabot - https://www.drupal.org/lullabot
