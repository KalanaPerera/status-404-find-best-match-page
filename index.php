<?php

// Status 404 Find Best Match Page
// Example of usage
// www.colossalmind.com

//-------
// Sometimes, status 404 is triggered inside your HTTP server. In such case,
// the server is requesting page '/404/'. This is defined inside your
// htaccess file (or config file of nginx).
// Clearly, page '/404/' is one that exists.
//-------
// This example assumes that inside your htaccess file (or config file of nginx)
// you rewrite all (qualifying) requests into index.php file.
// Example of nginx configuration:
//
//	error_page  404  /index.php?page=/404/;
//	location / {
//        rewrite ^(/[a-zA-Z0-9\-/\s]*)$   /index.php?page=$1   last;
//    }
//
//-------
// Only those pages '/404/' requested by your HTTP server will be considered as
// "hard error 404".
// Other pages will be considered as "soft error 404" (status 302) if they are 
// not listed in the valid URI array below.
//-------


// We *must* have an array that contains the valid URIs of all pages that exist.
// We should agree that only these characters can be used in a valid page name:
//    a-z, 0-9, - and _

$valid_uris = array(
	'/',
	'/about/',
	'/products/',
	'/products/antique-cars/',
	'/products/contemporary-cars/',
	'/products/kitchen-sink/',
	'/contact/',
	'/legal-terms-and-conditions/',
	'/404/'
	);

// NOTE: If you use other name for your page 404 other than '/404/', you'll
// need to change it inside the class.

// Requested page name, query string:

$request = $_GET["page"];

if (strstr($_SERVER["REQUEST_URI"], '?') !== false) {
	list($x, $qstr) = explode('?', $_SERVER["REQUEST_URI"]);
}
else {
	$qstr = '';
}

// Let's see if requested page exists!

//----------------------------------------------------------------------
if ($request != '/404/' && !in_array($request, $valid_uris)) {
	// The requested page doesn't exist.
	// Let's call this a "soft error 404" and we will reply with
	// status 302 instead (redirect to a page that exists).
	require dirname(__FILE__).'/class.status-404-find-best-match-page.php';
	$correction = new status_404_find_best_match_page($request, $valid_uris, $qstr);
	$correction->best_match(); // Here we will redirect with status 302 to a page with best match URI.
}
//----------------------------------------------------------------------

// If we got this far, the requested page exists.

// And below put more of your code that generates the web page...
// For example...

if ($request == '/') {
	echo 'Home';
}
elseif ($request == '/about/') {
	echo 'About';
}
elseif ($request == '/products/') {
	echo 'Products';
}
elseif ($request == '/products/antique-cars/') {
	echo 'Products > Antique Cars';
}
elseif ($request == '/products/contemporary-cars/') {
	echo 'Products > Contemporary Cars';
}
elseif ($request == '/products/kitchen-sink/') {
	echo 'Products > Kitchen Sink';
}
elseif ($request == '/contact/') {
	echo 'Contact';
}
elseif ($request == '/legal-terms-and-conditions/') {
	echo 'Legal Terms and Conditions';
}
elseif ($request == '/404/') {
	echo 'Status 404: Page not found';
	header("HTTP/1.1 404 Not Found");
}
else {
	echo 'ERROR: You have an error in your code.';
}

//----------------------------------------------------------------------


