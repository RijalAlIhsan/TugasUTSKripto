<?php
function encrypt($plaintext, $key1, $key2) {
    $result = '';

    // Loop through each character in the plaintext
    for ($i = 0; $i < strlen($plaintext); $i++) {
         $char =strtoupper($plaintext[$i]);
       

        // Check if the character is a letter
        if (ctype_alpha($char)) {
            // Convert the letter to its corresponding numeric value (A=0, B=1, ..., Z=25)
            $numericValue = ord($char) - ord('A');

            // Apply the encryption formula
            $encryptedValue = (($key1 * $numericValue) + $key2) % 26;

            // Convert the numeric value back to a letter
            $encryptedChar = chr($encryptedValue + ord('A'));

            // Append the encrypted letter to the result
            $result .= $encryptedChar;
        } else {
            // If the character is not a letter, leave it unchanged
            $result .= $char;
        }
    }

    return $result;
}

function decrypt($ciphertext, $key1, $key2) {
    $result = '';

    // Calculate the modular multiplicative inverse of $key1 modulo 26
    $modInverse = 0;
    for ($i = 1; $i < 26; $i++) {
        if (($key1 * $i) % 26 == 1) {
            $modInverse = $i;
            break;
        }
    }

    // Loop through each character in the ciphertext
    for ($i = 0; $i < strlen($ciphertext); $i++) {
        $char = strtoupper($ciphertext[$i]);

        // Check if the character is a letter
        if (ctype_alpha($char)) {
            // Convert the letter to its corresponding numeric value (A=0, B=1, ..., Z=25)
            $numericValue = ord($char) - ord('A');

            // Apply the decryption formula
            $decryptedValue = $modInverse * ($numericValue - $key2 + 26) % 26;

            // Convert the numeric value back to a letter
            $decryptedChar = chr($decryptedValue + ord('A'));

            // Append the decrypted letter to the result
            $result .= $decryptedChar;
        } else {
            // If the character is not a letter, leave it unchanged
            $result .= $char;
        }
    }

    return $result;
}
   
?>
