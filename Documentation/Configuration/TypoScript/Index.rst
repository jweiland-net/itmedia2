..  include:: /Includes.rst.txt


..  _typoscript:

===========
TypoScript
===========

`itmedia2` needs some basic TypoScript configuration. To do so you have
to add an +ext template to either the root page of your website or to a
specific page which contains the `itmedia2` plugin.

..  rst-class:: bignums

1.  Locate page

    You have to decide where you want to insert the TypoScript template. Either
    root page or page with `itmedia2` plugin is OK.

2.  Create TypoScript template

    Switch to template module and choose the specific page from above in the
    pagetree. Choose `Click here to create an extension template` from the
    right frame. In the TYPO3 community it is also known as "+ext template".

3.  Add static template

    Choose `Info/Modify` from the upper selectbox and then click
    on `Edit the whole template record` button below the little table. On
    tab `Includes` locate the section `Include static (from extension)`. Use
    the search above `Available items` to search for `itmedia2`. Hopefully
    just one record is visible below. Choose it, to move that record to
    the left.

4.  Save

    If you want you can give that template a name on tab "General", save
    and close it.

5.  Constants Editor

    Choose `Constant Editor` from the upper selectbox.

6.  `itmedia2` constants

    Choose `PLUGIN.TX_ITMEDIA2` from the category selectbox to show
    just `itmedia2` related constants

7.  Configure constants

    Adapt the constants to your needs. We prefer to set all
    these `pidOfListPage` and `pidOfDetailPage` constants. That prevents you
    from setting all these PIDs in each plugin individual.

8.  Configure TypoScript

    As constants will only allow modifying a fixed selection of TypoScript
    you also switch to `Info/Modify` again and click on `Setup`. Here you have
    the possibility to configure all `itmedia2` related configuration.

View
====

..  confval:: templateRootPaths

    :type: array
    :Default: EXT:itmedia2/Resources/Private/Templates/
    :Path: plugin.tx_itmedia2.view.*

    You can override our Templates with your own SitePackage extension. We
    prefer to change this value in TS Constants.

..  confval:: partialRootPaths

    :type: array
    :Default: EXT:itmedia2/Resources/Private/Partials/
    :Path: plugin.tx_itmedia2.view.*

    You can override our Partials with your own SitePackage extension. We
    prefer to change this value in TS Constants.

..  confval:: layoutsRootPaths

    :type: array
    :Default: EXT:itmedia2/Resources/Layouts/Templates/
    :Path: plugin.tx_itmedia2.view.*

    You can override our Layouts with your own SitePackage extension. We
    prefer to change this value in TS Constants.


Persistence
===========

..  confval:: storagePid

    :type: int
    :Default: 0
    :Path: plugin.tx_itmedia2.persistence

    Set this value to a Storage Folder (PID) where you have stored the records.


Settings
========

..  confval:: pidOfMaps2Plugin

    :type: int
    :Default: 0
    :Path: plugin.tx_itmedia2.settings

    Define the page UID where the EXT:maps2 plugin is located to show an
    address on a map.

..  confval:: pidOfDetailPage

    :type: int
    :Default: 0
    :Path: plugin.tx_itmedia2.settings

    If you have inserted the Industry Directory plugin for detail view onto
    another page, you can set its PID to this property here.

..  confval:: glossary.mergeNumbers

    :type: int
    :Default: 1
    :Path: plugin.tx_itmedia2.settings

    Merge record titles starting with numbers to `0-9` in glossary.

..  confval:: glossary.showAllLink

    :type: int
    :Default: 1
    :Path: plugin.tx_itmedia2.settings

    Prepend an additional button in front of the glossary to show
    all records again.

..  confval:: pageBrowser.itemsPerPage

    :type: int
    :Default: 15
    :Path: plugin.tx_itmedia2.settings

    Reduce result of records to this value for a page
