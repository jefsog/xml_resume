<?php
//$str="password";
$str=
'
<?xml version="1.0" encoding="UTF-8" ?>
<resume>
<name>
Jeff
</name>
<contact>
<tel>
234
</tel>
<address>
<street_number>
255
</street_number>
<street_name>
humber bolverd
</street_name>
</address>
</contact> 




'; //208 characters, which is the up range my key can work with. Beyond that, it doesnot work.
//I use 2048 bit key, so it can enctry no more than 2048/8=256 byte data. 
/*
<education>
humber
</education>
</resume>

';
*/
$encrypted=public_encrypt($str);
echo $encrypted;
echo "<br>";
echo private_decrypt($encrypted);

function public_encrypt($plaintext){
    $fp=fopen("publickey","r");
    $pub_key=fread($fp,8192);
    fclose($fp);
    openssl_get_publickey($pub_key);
    openssl_public_encrypt($plaintext,$crypttext, $pub_key );
    return(base64_encode($crypttext));
}
        
function private_decrypt($encryptedext){
	$fp=fopen("privatekey","r");
	$priv_key=fread($fp,8192);
	fclose($fp);
	$private_key = openssl_get_privatekey($priv_key);
	openssl_private_decrypt(base64_decode($encryptedext), $decrypted, $private_key);
	return $decrypted;
}

/*
$str = '<?xml version="1.0" encoding="UTF-8" ?>
<resume>
<name>
Jeff
</name>
<contact>
<tel>
234
</tel>
<address>
<street_number>
255
</street_number>
<street_name>
humber bolverd
</street_name>
</address>
</contact>
<education>
humber
</education>
</resume>';
*/

?>

