<?php

class verschluesseln extends db{

//Verschlüsselungen und entschlüsselungen

public function ver($string,$key,$key2){
  $string = openssl_encrypt($string,"AES-128-ECB",$key);
  $string = openssl_encrypt($string,"AES-128-ECB",$key2);
  return $string;
}


public function ent($string,$key,$key2){
  $string = openssl_decrypt($string,"AES-128-ECB",$key2);
  $string = openssl_decrypt($string,"AES-128-ECB",$key);
  return $string;
}

}//end class

$ver = new verschluesseln;
?>
