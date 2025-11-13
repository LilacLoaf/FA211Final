<?php

class UserModel
{
    // private data members
    private Database $db;
    private mysqli $dbConnection;
    static private ?UserModel $_instance = null;
    private string $tblUsers;

    // Private constructor for Singleton pattern
    private function __construct()
    {
        $this->db = new Database(); // ✅ FIXED: replaced getDatabase()
        $this->dbConnection = $this->db->getConnection();
        $this->tblUsers = $this->db->getUserTable();

        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    public function add_user(array $data): bool
    {
        $id = $this->dbConnection->real_escape_string($data['user_id']);
        $username = $this->dbConnection->real_escape_string($data['username']);
        $hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $name = $this->dbConnection->real_escape_string($data['fullname']);
        $email = $this->dbConnection->real_escape_string($data['email']);

        $sql = "INSERT INTO " . $this->tblUsers . " (user_id, username, password, fullname, email)
                VALUES ('$id', '$username', '$hash', '$name', '$email')";

        return $this->dbConnection->query($sql) ? true : false;
    }

    public function verify_user(string $username, string $password): bool
    {
        $username = $this->dbConnection->real_escape_string($username);
        $sql = "SELECT password FROM " . $this->tblUsers . " WHERE username='$username'";
        $query = $this->dbConnection->query($sql);

        if ($query && $row = $query->fetch_assoc()) {
            $hash = $row['password'];
            if (password_verify($password, $hash)) {
                setcookie("username", $username, time() + 3600, "/");
                return true;
            }
        }

        return false;
    }

    public function logout(): bool
    {
        if (isset($_COOKIE['username'])) {
            setcookie("username", "", time() - 3600, "/");
        }
        return true;
    }

    public function reset_password(string $username, string $password): bool
    {
        $username = $this->dbConnection->real_escape_string($username);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE " . $this->tblUsers . " SET password='$hash' WHERE username='$username'";
        return $this->dbConnection->query($sql);
    }

    // ✅ Singleton access method
    public static function getInstance(): UserModel
    {
        if (self::$_instance === null) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }
}

