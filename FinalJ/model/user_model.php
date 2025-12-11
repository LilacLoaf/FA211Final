<?php
/**
 * Author: Jonathan Nguyen
 * Date: 12/4/2025
 * File: model.php
 * Description: Cars Model (Singleton) - Works with Database Singleton
 */

class UsersModel
{

    private Database $db;
    private mysqli $conn;
    private static ?UsersModel $_instance = null;

    // table names
    private string $tblUsers;
    private string $tblJunction;

    private function __construct()
    {

        $this->db = Database::getDatabase();
        $this->conn = $this->db->getConnection();

        // get table names from Database class
        $this->tblUsers = $this->db->getUsersTable();
        $this->tblJunction = $this->db->getJunctionTable();

        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->conn->real_escape_string($value);
        }
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->conn->real_escape_string($value);
        }
    }

    public static function getModel(): UsersModel
    {
        if (self::$_instance === null) {
            self::$_instance = new UsersModel();
        }
        return self::$_instance;
    }

    //basically replaced all the cars functions with users commands


    //would list all users if we need that later
    public function getUsers(): array|false
    {
        $sql = "SELECT * FROM $this->tblUsers";
        $result = $this->conn->query($sql);

        if (!$result) return false;

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }


    //get the individual user for login later
    public function getUserByID($id): array|false
    {
        $sql = "SELECT * FROM $this->tblUsers WHERE id='$id' LIMIT 1";
        $result = $this->conn->query($sql);

        return ($result && $result->num_rows > 0)
            ? $result->fetch_assoc()
            : false;
    }

//create a new user
    public function insertUser(string $name, string $email, string $phone, string $address, string $username, string $password): bool
    {
        // hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "INSERT INTO $this->tblUsers (name, email, phone, address, username, password) Values (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssss", $name, $email, $phone, $address, $username, $hashedPassword);

        return $stmt->execute();
    }

    public function verify(string $username, string $password): array|false
    {
        $sql = "SELECT * FROM $this->tblUsers WHERE username=? AND password=? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            return $result->fetch_assoc();
        }
        return false;
    }







}