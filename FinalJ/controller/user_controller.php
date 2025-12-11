<?php
class UsersController
{
    private UsersModel $usersModel;

    public function __construct()
    {
        try {
            $this->usersModel = UsersModel::getModel();
        } catch (Exception $e) {
            echo "<p><strong>Error initializing UsersController:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public function signin(): void
    {
        try {
            $view = new loginView();
            $view->display();
        } catch (Exception $e) {
            echo "<p><strong>Error displaying sign-in page:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public function login(): void
    {
        try {
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

        } catch (Exception $e) {
            echo "<p><strong>Error during login:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public function logout(): void
    {
        try {
            session_start();
            unset($_SESSION['username']);
            unset($_SESSION['user_id']);

            header('Location: ' . BASE_URL . '/index.php');
            exit();
        } catch (Exception $e) {
            echo "<p><strong>Error during logout:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public function dashboard(): void
    {
        try {
            session_start();

            $user_id = $_SESSION['user_id'] ?? null;

            if (!$user_id) {
                header('Location: ' . BASE_URL . '/index.php/users/signin');
                exit();
            }

            $user = $this->usersModel->getUserByID($user_id);

            if (!$user) {
                throw new Exception("User not found.");
            }

            $view = new dashboardView();
            $view->display($user);

        } catch (Exception $e) {
            echo "<p><strong>Error loading dashboard:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
}

