<?php
session_start();
require_once 'models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $password = trim($_POST['password']);

    $userModel = new UserModel();
    $user = $userModel->login($nama, $password);

    if ($user === "not_admin") {
        $_SESSION['error_message'] = "Akses ditolak! Hanya admin yang dapat login ke CMS.";
        header("Location: login.php");
        exit;
    }

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        header("Location: index.html");
        exit;
    } else {
        $_SESSION['error_message'] = "Nama atau password salah.";
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
