<?php
class UsersController
{
    private UsersModel $usersModel;
    public function __construct()
    {
        $this->usersModel = UsersModel::getModel();
    }
    public function signin(): void
    {
        $view = new loginView();
        $view->display();
    }

    public function login(): void
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->usersModel->verify($username, $password);

        if ($user) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            header('Location: ' . BASE_URL . '/index.php/users/dashboard');
            exit();
        } else {
            $view = new loginView();
            $view->display('Invalid username or password');

        }
    }

public function logout(): void{
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        header('Location: ' . BASE_URL . '/index.php');
        exit();
}

    public function dashboard(): void
    {
        session_start();

        //pull the user id from the sessino
        $user_id = $_SESSION['user_id'] ?? null;

        if (!$user_id) {
            header('Location: ' . BASE_URL . '/index.php/users/signin');
            exit();
        }
        $user = $this->usersModel->getUserByID($user_id);

        if (!$user) {
            echo "User not found!";
            exit();
        }

        $view = new dashboardView();
        $view->display($user);
    }
}
