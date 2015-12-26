<?php

// generate a 2048 bit rsa private key, returns a php resource, save to file
$privateKey = openssl_pkey_new(array(
	'private_key_bits' => 2048,
	'private_key_type' => OPENSSL_KEYTYPE_RSA,
));
//echo openssl_error_string();
openssl_pkey_export_to_file($privateKey, 
	'C:\xampp1\htdocs\PHP_array_to_xml\privatekey');
 
// get the public key $keyDetails['key'] from the private key;
$keyDetails = openssl_pkey_get_details($privateKey);
file_put_contents('C:\xampp1\htdocs\PHP_array_to_xml\publickey', $keyDetails['key']);


//another example
/*
$config = array(

    "digest_alg" => "sha512",
    "private_key_bits" => 4096,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);
*/   
// Create the private and public key
//$res = openssl_pkey_new($config);
//echo openssl_error_string();
// Extract the private key from $res to $privKey
//openssl_pkey_export($res, $privKey);

// Extract the public key from $res to $pubKey
//$pubKey = openssl_pkey_get_details($res);
//$pubKey = $pubKey["key"];

//$data = 'plaintext data goes here';

// Encrypt the data to $encrypted using the public key
//openssl_public_encrypt($data, $encrypted, $pubKey);

// Decrypt the data using the private key and store the results in $decrypted
//openssl_private_decrypt($encrypted, $decrypted, $privKey);

//echo $decrypted;


?>

<?php
/*
Getting the public key corresponding to a particular private key, 
through the methods provided for by OpenSSL, 
is a bit cumbersome. An easier way to do it is to use phpseclib, 
a pure PHP RSA implementation:
Doesn't require any extensions be installed.  
It'll use bcmath or gmp if they're available, for speed, 
but doesn't even require those.

*/
/*
include('Crypt/RSA.php');

$rsa = new Crypt_RSA();
$rsa->loadKey('...');

$privatekey = $rsa->getPrivateKey();
$publickey = $rsa->getPublicKey();
*/
?>