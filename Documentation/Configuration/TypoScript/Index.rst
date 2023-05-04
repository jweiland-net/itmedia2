.. include:: ../../Includes.txt

.. _configuration:

=============
Configuration
=============

.. tip::

   You must configure the extension itmedia2 first to run this extension correctly.

   `Maps2 Documentation <https://docs.typo3.org/p/jweiland/maps2/master/en-us/>`_


View
====

view.templateRootPaths
""""""""""""""""""""""

Default: Value from Constants *EXT:itmedia2/Resources/Private/Templates/*

You can override our Templates with your own SitePackage extension. We prefer to change this value in TS Constants.

view.partialRootPaths
"""""""""""""""""""""

Default: Value from Constants *EXT:itmedia2/Resources/Private/Partials/*

You can override our Partials with your own SitePackage extension. We prefer to change this value in TS Constants.

view.layoutsRootPaths
"""""""""""""""""""""

Default: Value from Constants *EXT:itmedia2/Resources/Layouts/Templates/*

You can override our Layouts with your own SitePackage extension. We prefer to change this value in TS Constants.


Persistence
===========

persistence.storagePid
""""""""""""""""""""""

Set this value to a Storage Folder (PID) where you have stored the records.

Example: `plugin.tx_itmedia2.settings.pidOfMaps2Plugin = 21,45,3234`


Settings
========

settings.pidOfMaps2Plugin
"""""""""""""""""""""""""

Default: 0

Example: `plugin.tx_itmedia2.settings.pidOfMaps2Plugin = 12`

Define the page UID where the EXT:maps2 plugin is located to show an address on a map.

setting.pidOfDetailPage
"""""""""""""""""""""""

Default: 0

Example: `plugin.tx_itmedia2.settings.pidOfDetailPage = 84`

If you have inserted the Industry Directory plugin for detail view onto another
page, you can set its PID to this property here.

settings.glossary.mergeNumbers
""""""""""""""""""""""""""""""

Default: 1

Example: `plugin.tx_itmedia2.settings.glossary.mergeNumbers = 0`

Merge record titles starting with numbers to `0-9` in glossary.

settings.glossary.showAllLink
"""""""""""""""""""""""""""""

Default: 1

Example: `plugin.tx_itmedia2.settings.glossary.showAllLink = 0`

Prepend an additional button in front of the glossary to show all records again.

settings.pageBrowser.itemsPerPage
"""""""""""""""""""""""""""""""""

Default: 15

Example: `plugin.tx_itmedia2.settings.pageBrowser.itemsPerPage = 20`

Reduce result of records to this value for a page