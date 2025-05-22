<?php

namespace App\Controller;

use PDO;

class AuthController
{
    private $pdo;

    public function __construct()
    {
        require_once __DIR__ . '/../Middlewares/middleware.php';
        require_once __DIR__ . '/../../templates/render.php';
        require __DIR__ . '/../../config/database.php';
        $this->pdo = $pdo;
        session_start();
    }

    public function login()
    {
        isGuestRedirectIfAuthenticated();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                ];

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header('Location: /dashboard/');
                } else {
                    header('Location: /home');
                }
                exit;
            } else {
                $error = "Email atau password salah.";
            }
        }

        // Tampilkan form login
        render('auth/login', ['error' => $error ?? null]);
    }

    public function register()
    {
        isGuestRedirectIfAuthenticated();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT);
            $role = 'user';

            $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $password, $role]);

            header('Location: /auth/login');
            exit;
        }

        // Tampilkan form register
        render('auth/register');
    }
}
