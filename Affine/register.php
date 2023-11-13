<?php
require_once('koneksi.php');
require_once('helper.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kunci enkripsi
    $key1 = 5;
    $key2 = 8;
    
    // Enkripsi kata sandi
    $hashed_password = encrypt($password, $key1, $key2);

    // Hash password sebelum disimpan di database
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO tblogin (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>