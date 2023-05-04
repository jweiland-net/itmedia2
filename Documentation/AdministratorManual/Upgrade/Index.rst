..  include:: /Includes.rst.txt


=======
Upgrade
=======

If you update `itmedia2` to a newer version, please read this
section carefully!

Update to Version 3.0.11
========================

We have changed some method arguments, please flush cache in InstallTool

Update to Version 3.0.0
=======================

We have removed column wsp_member as this column was a specific column for one
of our customers. If you have used it you have to add it back with
help of EXT:extender.

We have removed column icon from table sys_category. That way we also have
removed fallbackIconPath, too. If you have used it you have to add it back
with help of EXT:extender.

We are using the API of glossary2 now. Please check, if your own queries
are still working.
