<?php

namespace Bootlace\Crypt;

use Sodium;

class CryptManager
{
    /**
     * Crypt constructor.
     */
    function __construct() {}

    /**
     * Encrypt a string.
     *
     * @param string $message
     * @return string
     */
    public static function encrypt($message)
    {
        $nonce = Sodium\randombytes_buf(
            Sodium\CRYPTO_SECRETBOX_NONCEBYTES
        );

        $cipher = base64_encode(
            $nonce .
            Sodium\crypto_secretbox(
                $message,
                $nonce,
                hex2bin(SECRET_KEY)
            )
        );
        Sodium\memzero($message);
        return $cipher;
    }

    /**
     * Decrypt a string.
     *
     * @param string $encrypted
     * @return bool|string
     */
    public static function decrypt($encrypted)
    {
        $decoded = base64_decode($encrypted);
        $nonce = mb_substr($decoded, 0, Sodium\CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $ciphertext = mb_substr($decoded, Sodium\CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');

        $plain = Sodium\crypto_secretbox_open(
            $ciphertext,
            $nonce,
            hex2bin(SECRET_KEY)
        );
        Sodium\memzero($ciphertext);
        return $plain;
    }
}