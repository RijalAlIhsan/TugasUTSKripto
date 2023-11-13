<?php
require_once('koneksi.php');
require_once('helper.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kunci dekripsi
    $key1 = 5;
    $key2 = 8;

    $sql = "SELECT * FROM tblogin WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $encryptedPassword = $row["password"];

        // Dekripsi kata sandi
        $decryptedPassword = decrypt($encryptedPassword, $key1, $key2);
        // if (password_verify($password, $row['password'])) {
            if (strtolower($password) == strtolower($decryptedPassword)) {
            echo "Login berhasil";
        } else {
            echo "Password salah";
        }
    } else {
        echo "Username tidak ditemukan";
    }
}

$conn->close();
?>