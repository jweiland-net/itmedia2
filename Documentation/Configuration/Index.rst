.. include:: ../Includes.txt


.. _configuration:

=============
Configuration
=============

Target group: **Developers, Integrators**

How to configure the extension. Try to make it easy to configure the extension.
Give a minimal example or a typical example.


Minimal Example
===============

- It is necessary to include static template `IT & Media (itmedia2)`

We prefer to set a Storage PID with help of TypoScript Constants:

.. code-block:: none

   plugin.tx_itmedia2.persistence {
      # Define Storage PID where company records are located
      storagePid = 4
   }

.. _configuration-typoscript:

TypoScript Setup Reference
==========================


.. _pidOfMaps2Plugin:

pidOfMaps2Plugin
----------------

Default:

If you have assigned an EXT:maps2 PoiCollection record to company record you set this value to
a PID where you have inserted the EXT:maps2 plugin.


.. _pidOfDetailPage:

pidOfDetailPage
---------------

Example: plugin.tx_itmedia2.settings.pidOfDetailPage = 4

If you have inserted the Industry Directory plugin for detail view onto another
page, you can set its PID to this property here.


.. _pageBrowser:

pageBrowser
-----------

You can fine tuning the page browser

Example: plugin.tx_itmedia2.settings.pageBrowser.itemsPerPage = 15
Example: plugin.tx_itmedia2.settings.pageBrowser.insertAbove = 1
Example: plugin.tx_itmedia2.settings.pageBrowser.insertBelow = 0
Example: plugin.tx_itmedia2.settings.pageBrowser.maximumNumberOfLinks = 5

**itemsPerPage**

Reduce result of company records to this value for a page

**insertAbove**

Insert page browser above list of company records

**insertBelow**

Insert page browser below list of company records. I remember a bug in TYPO3 CMS. So I can not guarantee
that this option will work.

**maximumNumberOfLinks**

If you have many company records it makes sense to reduce the amount of pages in page browser to a fixed maximum
value. Instead of 1, 2, 3, 4, 5, 6, 7, 8 you will get 1, 2, 3...8, 9 if you have configured this option to 5.
