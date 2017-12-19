<?php

function encrypt ($encrypt, $key = '12345678'){
	$block = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_ECB);
	$pad = $block - (strlen($encrypt) % $block);
	$encrypt .= str_repeat(chr($pad), $pad);
	$passcrypt = @mcrypt_encrypt(MCRYPT_DES, $key, $encrypt, MCRYPT_MODE_ECB);
	return base64_encode($passcrypt);
}

function decrypt($encrypt,$key = '12345678') {
     // ����Ҫ�O�� IV
     $str = mcrypt_decrypt(MCRYPT_DES, $key, base64_decode($encrypt), MCRYPT_MODE_ECB);
     // ���� PKCS#7 RFC 5652 Cryptographic Message Syntax (CMS) ���� Message �Ƴ� Padding
     $pad = ord($str[strlen($str) - 1]);
     return substr($str, 0, strlen($str) - $pad);
 }