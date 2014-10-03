<?php

class crypto {

    public static function create_symmetric_key($length = 1024)
    {
        $key = openssl_random_pseudo_bytes($length, $strong);
        if (!$strong)
        {
            // Key is not considered to cryptographically strong, throw error. See: http://php.net/manual/en/function.openssl-random-pseudo-bytes.php
            throw new Exception("Random Key Generation is not strong!");
        }
        return $key;
    }

    public static function create_asymmetric_keypair($bits = 1024)
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



}