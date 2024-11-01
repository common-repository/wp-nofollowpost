<?php
/*
Plugin Name: WP-NofollowPost
Plugin URI: http://www.psxdns.com/wp-nofollowpost/
Description: Simply adds a nofollow tag to all links within a post.
Author: psxdns
Version: 1.0
Author URI: http://www.psxdns.com/

#### COPYRIGHT:		This program is free software: you can redistribute it and/or modify
			it under the terms of the GNU General Public License as published by
			the Free Software Foundation, either version 3 of the License, or
			(at your option) any later version.

			This program is distributed in the hope that it will be useful,
			but WITHOUT ANY WARRANTY; without even the implied warranty of
			MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
			GNU General Public License for more details.

			You should have received a copy of the GNU General Public License
			along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


// integrate with wordpress
add_filter('the_content','run_nofopo');


// main function
function run_nofopo($string) {
preg_match_all("/<a.*? href=\"(.*?)\".*?>(.*?)<\/a>/i", $string, $hits);
for($i=0;$i<count($hits[0]);$i++)
	{
	if(!preg_match("/rel=[\"\']*nofollow[\"\']*/",$hits[0][$i]))
		{
		preg_match_all("/<a.*? href=\"(.*?)\"(.*?)>(.*?)<\/a>/i", $hits[0][$i], $hits1);
		$string = str_replace(">".$hits1[3][0]."</a>"," rel='nofollow'>".$hits1[3][0]."</a>",$string);
		}
	}
return $string;
}
?>