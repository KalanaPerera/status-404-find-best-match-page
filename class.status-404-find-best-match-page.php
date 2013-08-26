<?php

/**
 *
 * Status 404 Find Best Match Page
 * Copyright (c) 2013 Peter Kahl. All rights reserved.
 * Use of this source code is governed by a GNU General Public License
 * that can be found in the LICENSE file.
 * Version 1.0.0 ..... 2013-08-26
 *
 * https://github.com/peterkahl/status-404-find-best-match-page
 *
 */


class status_404_find_best_match_page {

	private $exists;
	private $request;

	// If unable to find closest match, default to:
	// (change as needed)
	private $closest = '/';

	public function __construct($request, $exists, $qstr = '') {
		$this->exists  = $exists;
		$this->request = $request;
		if (empty($qstr)) $this->qstr = '';
		else $this->qstr = '?'.$qstr;
	}

	public function best_match() {
		$a = str_replace(array('/','-','_','"',"'",'%20',' '), '', strtolower($this->request));
		$distance = -1;
		foreach ($this->exists as $pg) {
			if ($pg != '/404/') {
				$b = str_replace(array('/','-','_'), '', $pg);
				$lev = levenshtein($a, $b);
				// exact match
				if ($lev == 0) {
					$this->closest = $pg;
					$distance = 0;
					break;
				}
				elseif ($lev <= $distance || $distance < 0) {
					$this->closest = $pg;
					$distance = $lev;
				}
			}
		}
		$len1 = strlen($a);
		if (1.5*$distance > $len1) {
			foreach ($this->exists as $pg) {
				if ($pg != '/404/') {
					$b = str_replace(array('/','-','_'), '', $pg);
					$len2 = strlen($b);
					if ($len1 > 0 && $len2 > 0 && $len1 > $len2) {
						if (strstr($a, $b) !== false) {
							$this->closest = $pg;
							break;
						}
					}
					elseif ($len1 > 0 && $len2 > 0) {
						if (strstr($b, $a) !== false) {
							$this->closest = $pg;
							break;
						}
					}
				}
			}
		}
		// reload
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: http://".$_SERVER["HTTP_HOST"].$this->closest.$this->qstr);
		exit();
	}
}

//----------------------------------------------------------------------

