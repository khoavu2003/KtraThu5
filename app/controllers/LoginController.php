<?php
require_once('app/config/database.php');
require_once('app/models/UserModel.php');

class LoginController {
    private $userModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    public function index() { // Thay vì login(), dùng index() để mặc định gọi khi vào /login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            $user = $this->userModel->getUserByUsername($username);
            
            if ($user && $password === $user['password']) {
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'fullname' => $user['fullname'],
                    'role' => $user['role']
                ];
                header('Location: /Ktra');
                exit;
            } else {
                echo "Sai tài khoản hoặc mật khẩu!";
            }
        }
        include 'app/views/auth/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /Ktra/login');
        exit;
    }
}
