Status 404 Find Best Match Page
===============================

[https://github.com/peterkahl/status-404-find-best-match-page](https://github.com/peterkahl/status-404-find-best-match-page)

About
=====

This PHP class catches all "soft errors 404" and finds the closest (best,
most likely) candidate page name (URI) from a list of pages that exist.

Soft error 404 is defined as one that is initiated by this PHP script:

* The script compares the current request against a list of existent pages.
* If match isn't found (soft error 404), a closest match is found.
* The script replies with status 302 (permanent redirect) to the existent
  page.

Hard error 404 is initiated by HTTP server.

Functionality of this class depends on properly set up rewrites inside
htaccess (or nginx configuration) file.

**NGINX example:**

```nginx
server {
	error_page  404  /index.php?page=/404/;
	location / {
        rewrite ^(/[a-zA-Z0-9\-/\s]*)$   /index.php?page=$1   last;
    }
}
```

