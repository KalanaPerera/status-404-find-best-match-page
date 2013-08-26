<?php

// Status 404 Find Best Match Page
// Example of usage

// Sometimes, status 404 is triggered inside your HTTP server. In such case,
// the server is requesting page '/404/'. This is defined inside your
// htaccess file (or config file of nginx).
// Clearly, page '/404/' is one that exists.


// We *must* have an array that contains the valid URIs of all pages that exist.
// We should agree that only these characters can be used as valid page name:
//    a-z, 0-9, - and _

$exists = array(
	'/',
	'/about/',
	'/products/',
	'/products/antique-cars/',
	'/contact/',
	'/404/'
	);

// Requested page name

$request = reset(explode('?', $_SERVER["REQUEST_URI"]));

// Let's see if requested page exists!

//----------------------------------------------------------------------
if (!in_array($request, $exists)) {
	// requested page doesn't exist
	require dirname(__FILE__).'/class.status-404-find-best-match-page.php';
	$correction = new status_404_find_best_match_page($request, $exists);
	$correction->best_match(); // Here we will redirect with status 302 to a page with closest match URI.
}
//----------------------------------------------------------------------

// If we got this far, the requested page exists.

// And below put more of your code that generates the web page...

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
elseif ($request == '/contact/') {
	echo 'Contact';
}
elseif ($request == '/404/') {
	echo 'Status 404: Page not found';
	header("HTTP/1.1 404 Not Found");
}
else {
	echo 'ERROR: You have an error in your code.';
}

//----------------------------------------------------------------------


