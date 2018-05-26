=== Export API ===
Contributors: Sergey Zaharchenko
Tags: maxsite, import, wordpress
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Plugin Export API provides possibility to get site content by API.
It was developed to be used in the bunch with WordPress plugin "Importer From MaxSite"
for moving your data from MaxSite CMS to the WordPress.

For now, realized such endpoints:
 * export_api/v1/categories - returns all categories.
 * export_api/v1/pages - returns all pages.
 * export_api/v1/category/{category_number}/pages - returns pages from category.

Data returns in JSON format.

Feel free to submit questions, suggestions, bug reports, concerns, etc. to me.

Steps to import the data from your MaxSite CMS site:
* Install "Export API" (https://github.com/zahardoc/export_api) plugin on the MaxSite CMS site
* Install "Importer From MaxSite" (https://github.com/zahardoc/importer-from-maxsite) plugin on your WordPress site.
* Go to the "Importer From MaxSite" page.
* Provide your MaxSite url and click "Import Content" button.

== Changelog ==
= Version 1.1 =
* Added page comments data to export_api/v1/pages endpoint
