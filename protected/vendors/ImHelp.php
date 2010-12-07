<?php
	class ImHelp
	{
		/**
		 *
		 */
		public static function stringToUrl( $str )
		{
			$tmp = preg_replace('/\s+/', '-', $str ); // compress internal whitespace and replace with -
			// $tmp = preg_replace('/\W+/', '', $tmp ); // remove all non-alphanumeric chars 
	    	return strtolower(preg_replace('/\W-/', '', $tmp) );
		}
	}
