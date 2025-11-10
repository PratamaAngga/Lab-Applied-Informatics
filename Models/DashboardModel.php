<?php
/**
 * FILE: models/DashboardModel.php
 * FUNGSI: Mengambil data agregat untuk dashboard
 */
require_once __DIR__ . '/../config/koneksi.php';
class DashboardModel {
    private $conn;

    public function __construct() {
        $database = new Koneksi();
        $this->conn = $database->getConnection();
    }

    // Total Produk
    public function getTotalProduct() {
        $stmt = $this->conn->query("SELECT COUNT(id_product) AS jumlah_product FROM product");
        return $stmt->fetch(PDO::FETCH_ASSOC)['jumlah_product'] ?? 0;
    }

    // Dosen dengan publikasi terbanyak
    public function getMostPublication() {
        $sql = "SELECT u.name, COUNT(p.id_publication) AS total_publikasi
                FROM users u
                LEFT JOIN publication p ON u.id_user = p.id_user
                GROUP BY u.id_user, u.name
                ORDER BY total_publikasi DESC
                LIMIT 1";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Dosen dengan publikasi paling sedikit
    public function getLeastPublication() {
        $sql = "SELECT u.name, COUNT(p.id_publication) AS total_publikasi
                FROM users u
                LEFT JOIN publication p ON u.id_user = p.id_user
                GROUP BY u.id_user, u.name
                ORDER BY total_publikasi ASC
                LIMIT 1";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Rata-rata publikasi per dosen
    public function getAveragePublication() {
        $sql = "SELECT ROUND(AVG(jumlah_publikasi), 2) AS rata_publikasi
                FROM (
                    SELECT COUNT(p.id_publication) AS jumlah_publikasi
                    FROM users u
                    LEFT JOIN publication p ON u.id_user = p.id_user
                    GROUP BY u.id_user
                ) sub";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC)['rata_publikasi'] ?? 0;
    }
}
