<?php

namespace App\Support;

use Exception;

class OpenSSL
{
    /**
     * Encrypts a value using OpenSSL with the specified algorithm.
     * @param string $value
     * @return string
     * @throws Exception
     */
    public static function encrypt(string $value): string
    {
        $key = self::getKey();
        $iv = self::getIV();

        $encryptedValue = openssl_encrypt($value, config('app.cipher'), $key, 0, $iv);

        if ($encryptedValue === false) {
            throw new Exception('Failed to encrypt the value');
        }

        return base64_encode($iv . $encryptedValue);
    }

    /**
     * Decrypts a value using OpenSSL with the specified algorithm.
     * @param string $encryptedValue
     * @return string
     * @throws Exception
     */
    public static function decrypt(string $encryptedValue): string
    {
        $key = self::getKey();
        $iv = self::getIV();

        $decoded = base64_decode($encryptedValue);
        $encryptedData = substr($decoded, 16);
        $decryptedValue = openssl_decrypt($encryptedData, config('app.cipher'), $key, 0, $iv);

        if ($decryptedValue === false) {
            throw new Exception('Failed to decrypt the value');
        }

        return $decryptedValue;
    }

    /**
     * Retrieve the encryption key from the application configuration.
     * @return string
     * @throws Exception
     */
    protected static function getKey(): string
    {
        $key = config('app.key');

        if (strlen($key) < 32) {
            throw new Exception('Key must be at least 32 characters long');
        }

        return substr($key, 0, 32);
    }

    /**
     * Retrieve the initialization vector from the application configuration.
     * @return string
     */
    protected static function getIV(): string
    {
        $iv = config('app.key');

        return substr($iv, -16);
    }
}

