<?php
define("ENCRYPTION_KEY", base64_decode("your-base64-encoded-32-byte-key")); // 32 bytes for AES-256
define("ENCRYPTION_IV", substr(base64_decode("your-base64-encoded-16-byte-iv"), 0, 16)); // Ensure 16 bytes

function encryptData($data) {
    return base64_encode(openssl_encrypt($data, 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_IV));
}

function decryptData($encryptedData) {
    return openssl_decrypt(base64_decode($encryptedData), 'aes-256-cbc', ENCRYPTION_KEY, 0, ENCRYPTION_IV);
}
?>