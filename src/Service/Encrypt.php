<?php


namespace App\Service;


use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class Encrypt
{
    function encrypt($content, $passphrase, $iv){
        $encryptAlgorithm = $_ENV["ENCRYPT_ALGO"];
        return openssl_encrypt($content, $encryptAlgorithm, $passphrase,0, $iv);
    }

    function decrypt($encryptedContent, $passphrase, $iv){
        $encryptAlgorithm = $_ENV["ENCRYPT_ALGO"];
        return openssl_decrypt($encryptedContent, $encryptAlgorithm, $passphrase, 0, $iv);
    }
}