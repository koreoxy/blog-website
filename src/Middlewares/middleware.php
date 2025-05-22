<?php
session_start();

/**
 * Middleware untuk mencegah akses login/register jika sudah login
 */
function isGuestRedirectIfAuthenticated(): void
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] === 'admin') {
            header('Location: /dashboard/index');
        } else {
            header('Location: /home');
        }
        exit;
    }
}

/**
 * Middleware untuk memastikan user sudah login
 */
function isAuthenticated(): void
{
    if (!isset($_SESSION['user'])) {
        header('Location: /auth/login');
        exit;
    }
}

/**
 * Middleware untuk memastikan user adalah admin
 */
function isAdmin(): void
{
    isAuthenticated();

    if ($_SESSION['user']['role'] !== 'admin') {
        header('Location: /home');
        exit;
    }
}

/**
 * Middleware untuk memastikan user adalah user biasa
 */
function isUser(): void
{
    isAuthenticated();

    if ($_SESSION['user']['role'] !== 'user') {
        header('Location: /home');
        exit;
    }
}
