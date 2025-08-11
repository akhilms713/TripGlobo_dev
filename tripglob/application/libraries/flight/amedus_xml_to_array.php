<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006 - 2012, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

class amedus_xml_to_array {

   function xml2ary(&$string) {
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parse_into_struct($parser, $string, $vals, $index);
    xml_parser_free($parser);

    $mnary=array();
    $ary=&$mnary;
    foreach ($vals as $r) {
        $t=$r['tag'];
        if ($r['type']=='open') {
            if (isset($ary[$t])) {
                if (isset($ary[$t][0])) 
				$ary[$t][]=array(); 
				else
				 $ary[$t]=array($ary[$t], array());
                $cv=&$ary[$t][count($ary[$t])-1];
            } 
			else $cv=&$ary[$t];
            if (isset($r['attributes']))
			{
			foreach ($r['attributes'] as $k=>$v) 
			$cv['_a'][$k]=$v;
			}
            $cv=array();
            $cv['_p']=&$ary;
            $ary=&$cv;

        } 
		elseif
		($r['type']=='complete')
		 {
            if (isset($ary[$t])) { // same as open
                if (isset($ary[$t][0])) $ary[$t][]=array(); else $ary[$t]=array($ary[$t], array());
                $cv=&$ary[$t][count($ary[$t])-1];
            } else $cv=&$ary[$t];
            if (isset($r['attributes'])) {foreach ($r['attributes'] as $k=>$v) $cv['_a'][$k]=$v;}
            $cv['_v']=(isset($r['value']) ? $r['value'] : '');

        } elseif ($r['type']=='close') {
            $ary=&$ary['_p'];
        }
    }    
    
    $this->_del_p($mnary);
		
    return $mnary;
	}
	
	// _Internal: Remove recursion in result array
	function _del_p(&$ary) {
		foreach ($ary as $k=>$v) {
			if ($k==='_p') unset($ary[$k]);
			elseif (is_array($ary[$k])) $this->_del_p($ary[$k]);
		}
	}
	
	// Array to XML
	function ary2xml($cary, $d=0, $forcetag='') {
		$res=array();
		foreach ($cary as $tag=>$r) {
			if (isset($r[0])) {
				$res[]=ary2xml($r, $d, $tag);
			} else {
				if ($forcetag) $tag=$forcetag;
				$sp=str_repeat("\t", $d);
				$res[]="$sp<$tag";
				if (isset($r['_a'])) {foreach ($r['_a'] as $at=>$av) $res[]=" $at=\"$av\"";}
				$res[]=">".((isset($r['_c'])) ? "\n" : '');
				if (isset($r['_c'])) $res[]=ary2xml($r['_c'], $d+1);
				elseif (isset($r['_v'])) $res[]=$r['_v'];
				$res[]=(isset($r['_c']) ? $sp : '')."</$tag>\n";
			}
			
		}
		return implode('', $res);
	}
	
	// Insert element into array
	function ins2ary(&$ary, $element, $pos) {
	$ar1=array_slice($ary, 0, $pos); $ar1[]=$element;
	$ary=array_merge($ar1, array_slice($ary, $pos));
	}


}
// END Cart Class

/* End of file Cart.php */
/* Location: ./system/libraries/Cart.php */
