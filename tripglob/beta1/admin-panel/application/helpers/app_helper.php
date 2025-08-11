<?php if (!defined('BASEPATH'))   exit('No direct script access allowed');



 function desc_array($var = NULL)
 {
    if($var && (is_array($var) || is_object($var)))
    {
        echo '<pre/>'; print_r($var);
    }
 }