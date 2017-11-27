<?php
namespace Hcode;

class Cipher{

    const PASSWORD = "HcodePhp7_scret";
    const METHOD = "AES-256-CBC";

    public static function encrypt($data)
    {
        $key = Cipher::keyEncrypt(Cipher::PASSWORD);
        $IV = openssl_random_pseudo_bytes(16);
         return base64_encode($IV . openssl_encrypt($data, Cipher::METHOD, $key , 0, $IV));
    }

    public static function decrypt($code)
    {
        $code = base64_decode($code);
        $key = Cipher::keyEncrypt(Cipher::PASSWORD);
        $IV = substr($code, 0, 16);
        $data = substr($code, 16, 48);
        return openssl_decrypt($data, Cipher::METHOD, $key, 0, $IV);
    }

    private static function keyEncrypt($password)
    {
        return hash('sha256', $password, true);
    }
}
