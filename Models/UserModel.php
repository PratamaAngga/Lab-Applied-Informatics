<?php
/**
 * FILE: models/UserModel.php
 * FUNGSI: Mengelola data pengguna (user) termasuk autentikasi login.
 */

require_once __DIR__ . '/../config/koneksi.php';

class UserModel {
    private $conn;
    private $table_name = "users"; // ubah kalau nama tabel kamu beda

    public function __construct() {
        $database = new Koneksi();
        $this->conn = $database->getConnection();
    }

    /**
     * Fungsi login berdasarkan kolom 'name' (username).
     * Hanya role 'admin' yang bisa login.
     * @param string $name
     * @param string $password
     * @return mixed (array user data jika benar dan admin, false atau "not_admin" jika gagal)
     */
    public function login($name, $password) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE name = :name LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $password == "admin123") {
                if (strtolower($user['role']) === 'admin') {
                    return $user;
                } else {
                    return "not_admin";
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error login: " . $e->getMessage();
            return false;
        }
    }
}
