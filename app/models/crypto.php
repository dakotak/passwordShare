<?php

class crypto {

    public static function create_symmetric_key($length = 32)
    {
        $key = openssl_random_pseudo_bytes($length, $strong);
        if (!$strong)
        {
            // Key is not considered to cryptographically strong, throw error. See: http://php.net/manual/en/function.openssl-random-pseudo-bytes.php
            throw new Exception("Random Key Generation is not strong!");
        }
        return $key;
    }

    public static function create_asymmetric_keypair($bits = 3072)
    {
        // Generate the keypair resource
        $resource = openssl_pkey_new(array(
            'private_key_bits' => $bits,
            'private_key_type' => OPENSSL_KEYTYPE_RSA
            ));
        // Get the pivate key
        openssl_pkey_export($resource, $privateKey);
        // Get the public key for this pair
        $keyDetails = openssl_pkey_get_details($resource);

        // Done with $resource
        openssl_free_key($resource);

        // Return the keys in an associative array
        return array('public' => $keyDetails['key'], 'private' => $privateKey);
    }

    public static function symmetric_encrypt($data, $key)
    {
        // Creaste the Initialization vector for encryption
        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($ivSize);

        $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);

        //Return the $iv concantinated with $encrypted
        return $iv . $encrypted;
    }

    public static function symmetric_decrypt($data, $key)
    {
        // Get the length of the Initialization Vector
        $ivLen = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        // Split the encrypted password into the IV and the encrypted data
        $iv = substr($data, 0, $ivLen);
        $encrypted = substr($data, $ivLen);
        return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $encrypted, MCRYPT_MODE_CBC, $iv);
    }

    public static function asymmetric_encrypt($data, $publicKey)
    {
        openssl_public_encrypt($data, $encrypted, $publicKey);
        return $encrypted;
    }

    public static function asymmetric_decrypt($data, $privateKey)
    {
        openssl_private_decrypt($data, $decrypted, $privateKey);
        return $decryped;
    }



}