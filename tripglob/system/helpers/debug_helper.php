<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function debug($ele = array()) {
	    echo '<pre>';
	    print_r($ele);
	    $data=debug_backtrace();
	    echo '<br>File Name => '.$data[0]['file'];
	    echo '<br>Line No => '.$data[0]['line'];
	}


		function insurance_loader(){ 
		echo  "<img src='https://tripglobo.com/assets/theme_dark/images/search_load.gif' width='100%' height='100%'> ";   
		return false; 

	}



		function get_tokens(){ 
				$token = "8926c986-3872-4389-a87f-ce17ed7776e0";
				return $token;

	}

		 