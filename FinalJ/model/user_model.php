<?php
/**
 * Users Model - Works with Database Singleton
 */

class UsersModel
{
    private Database $db;
    private mysqli $conn;
    private static ?UsersModel $_instance = null;

    private string $tblUsers;
    private string $tblJunction;

    private function __construct()
    {
        try {
            $this->db = Database::getDatabase();
            $this->conn = $this->db->getConnection();

            $this->tblUsers    = $this->db->getUsersTable();
            $this->tblJunction = $this->db->getJunctionTable();

            foreach ($_POST as $key => $value) {
                $_POST[$key] = $this->conn->real_escape_string($value);
            }
            foreach ($_GET as $key => $value) {
                $_GET[$key] = $this->conn->real_escape_string($value);
            }

        } catch (Exception $e) {
            echo "<p><strong>Error initializing UsersModel:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public static function getModel(): UsersModel
    {
        if (self::$_instance === null) {
            self::$_instance = new UsersModel();
        }
        return self::$_instance;
    }

    public function getUsers(): array|false
    {
        try {
            $sql = "SELECT * FROM $this->tblUsers";
            $result = $this->conn->query($sql);

            if (!$result) return false;

            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;

        } catch (Exception $e) {
            echo "<p><strong>Error retrieving users:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            return false;
        }
    }

    public function getUserByID($id): array|false
    {
        try {
            $sql = "SELECT * FROM $this->tblUsers WHERE id='$id' LIMIT 1";
            $result = $this->conn->query($sql);

            return ($result && $result->num_rows > 0)
                ? $result->fetch_assoc()
                : false;

        } catch (Exception $e) {
            echo "<p><strong>Error retrieving user by ID:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            return false;
        }
    }

    public function insertUser(string $name, string $email, string $phone, string $address, string $username, string $password): bool
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare(
                "INSERT INTO $this->tblUsers (name, email, phone, address, username, password)
                 VALUES (?, ?, ?, ?, ?, ?)"
            );

            if (!$stmt) {
                throw new Exception("Failed to prepare insert user statement.");
            }

            $stmt->bind_param("ssssss", $name, $email, $phone, $address, $username, $hashedPassword);
            return $stmt->execute();

        } catch (Exception $e) {
            echo "<p><strong>Error inserting user:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            return false;
        }
    }

    public function verify(string $username, string $password): array|false
    {
        try {
            $sql = "SELECT * FROM $this->tblUsers WHERE username=? AND password=? LIMIT 1";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Failed to prepare verify() SQL statement.");
            }

            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result && $result->num_rows === 1) {
                return $result->fetch_assoc();
            }

            return false;

        } catch (Exception $e) {
            echo "<p><strong>Error verifying credentials:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            return false;
        }
    }
}
