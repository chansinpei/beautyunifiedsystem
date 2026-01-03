<?php
define('AES_KEY', 'THIS_SHOULD_BE_32_BYTES_LONG_KEY!!'); // 32 bytes
define('AES_IV', '1234567890123456'); // 16 bytes

function encryptData($data) {
    return openssl_encrypt(
        $data,
        'AES-256-CBC',
        AES_KEY,
        OPENSSL_RAW_DATA,
        AES_IV
    );
}

function decryptData($data) {
    return openssl_decrypt(
        $data,
        'AES-256-CBC',
        AES_KEY,
        OPENSSL_RAW_DATA,
        AES_IV
    );
}
