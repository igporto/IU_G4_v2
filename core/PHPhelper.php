<?php 

/**
* Class to host the method toConsole that prints to console
* for debugging purposes
*/
class PHPhelper 
{
	
	private function __construct()
	{		
	}

	public function toConsole( $data ) {

	    if ( is_array( $data ) )
	        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	    else
	        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

	    echo $output;
	}	

    // singleton
	private static $phphelper_singleton = NULL;
	public static function getInstance() {
		if (self::$phphelper_singleton == null) {
			self::$phphelper_singleton = new PHPhelper();
		}
		return self::$phphelper_singleton;
	}


}

//force first instance
PHPhelper::getInstance();