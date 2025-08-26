<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('encrypt_ccavenue')) {
    function encrypt_ccavenue($plainText, $key)
    {
        $key = hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 
                                  0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        return bin2hex($openMode);
    }

}

if ( ! function_exists('decrypt_ccavenue')) {
    function decrypt_ccavenue($encryptedText, $key)
    {
        $key = hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 
                                  0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = hextobin($encryptedText);
        return openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    }
}

if ( ! function_exists('hextobin')) {
    function hextobin($hexString) 
    { 
        $length = strlen($hexString); 
        $binString = "";   
        $count = 0; 
        while ($count < $length) 
        {       
            $subString    = substr($hexString, $count, 2);           
            $packedString = pack("H*", $subString); 
            $binString   .= $packedString;
            $count += 2; 
        } 
        return $binString; 
    } 
}
