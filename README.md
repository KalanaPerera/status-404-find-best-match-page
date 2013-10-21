Status 404 Find Best Match Page
===============================

Copyright (c) 2012-2013, Peter Kahl. All rights reserved. www.colossalmind.com

[https://github.com/peterkahl/status-404-find-best-match-page](https://github.com/peterkahl/status-404-find-best-match-page)

About
=====

This PHP class catches all "soft errors 404" and finds the closest (best,
most likely) candidate page name (URI) from a list of pages that exist.

This class will benefit those concerned with search engine optimisation (SEO), and
in applications where URLs often change; it eliminates the need for URL rewrites.
Better name for this class may be INTELLIGENT URL REWRITE.

This class was nominated for INNOVATION AWARD (September 2013) at
[phpclasses.org](http://www.phpclasses.org/package/8219-PHP-Find-best-match-URL-when-accessing-an-invalid-page.html).

Soft error 404 is defined as one that is initiated by this PHP script:

* The script compares the current request against a list of existent pages.
* If match isn't found (soft error 404), a closest match is found.
* The script replies with status 302 (permanent redirect) to the existent
  page.

Hard error 404 is initiated by HTTP server.

Functionality of this class depends on properly set up rewrites inside
.htaccess (or nginx configuration) file.

**NGINX example:**

```nginx
server {
	error_page  404  /index.php?page=/404/;
	location / {
        rewrite ^(/[a-zA-Z0-9\-/\s]*)$   /index.php?page=$1   last;
    }
}
```

**Apache .htaccess example:**

```apache
ErrorDocument 404 index.php?page=/404/
RewriteRule ^([a-z0-9_-]+/([a-z0-9_-]+/)*)$ index.php?page=/$1 [NC]
```

License
=======

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see [http://www.gnu.org/licenses/](http://www.gnu.org/licenses/).

Change Log
==========

1.0.0 ..... 2013-08-26
	Initial release
