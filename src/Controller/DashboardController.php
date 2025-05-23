<?php

namespace App\Controller;

use App\Model\BlogModel;
use App\Lib\FileHelper;

class DashboardController
{
    public function __construct()
    {
        require_once __DIR__ . '/../Middlewares/middleware.php';
        require_once __DIR__ . '/../../templates/render.php';

        // Middleware: pastikan hanya admin yang bisa akses dashboard
        isAdmin();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];

        // render('PATH OR LINK', $data, 'LAYOUTS')
        render('dashboard/index', $data, 'dashboard');
    }

    public function blog()
    {
        require __DIR__ . '/../../config/database.php';
        $blogModel = new BlogModel($pdo);

        $blogs = $blogModel->getAllBlogs();

        $data = [
            'title' => 'Blog',
            'blogs' => $blogs
        ];

        render('dashboard/blog', $data, 'dashboard');
    }

    public function addBlog()
    {
        require __DIR__ . '/../../config/database.php';

        $blogModel = new \App\Model\BlogModel($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $author = $_SESSION['user']['name'] ?? 'Anonymous';

            $image = $_FILES['image'];
            $maxSize = 1048576; // 1MB

            if ($image['error'] === UPLOAD_ERR_OK) {
                if ($image['size'] <= $maxSize) {
                    $imageName = time() . '_' . basename($image['name']);
                    $uploadsDir = __DIR__ . '/../../public/uploads/';
                    $targetPath = $uploadsDir . $imageName;

                    // Pastikan folder uploads ada
                    FileHelper::ensureUploadsFolderExists($uploadsDir);

                    if (move_uploaded_file($image['tmp_name'], $targetPath)) {
                        $blogModel->createBlog($title, $description, $date, $author, $imageName);
                        $_SESSION['message'] = [
                            'type' => 'success',
                            'text' => '✅ Data blog berhasil ditambahkan.'
                        ];
                        header('Location: /dashboard/blog');
                        exit;
                    } else {
                        $_SESSION['message'] = [
                            'type' => 'error',
                            'text' => '❌ Gagal upload gambar.'
                        ];
                        header('Location: /dashboard/blog');
                        exit;
                    }
                } else {
                    $_SESSION['message'] = [
                        'type' => 'error',
                        'text' => '❌ Ukuran file tidak boleh lebih dari 1MB.'
                    ];
                    header('Location: /dashboard/blog');
                    exit;
                }
            } else {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => '❌ Terjadi kesalahan saat upload gambar.'
                ];
                header('Location: /dashboard/blog');
                exit;
            }
        }
    }

    public function updateBlog()
    {
        require __DIR__ . '/../../config/database.php';
        $blogModel = new \App\Model\BlogModel($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $date = $_POST['date'] ?? '';
            $author = $_SESSION['user']['name'] ?? 'Anonymous';

            $image = $_FILES['image'] ?? null;
            $imageName = null;

            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $maxSize = 1048576;

                if ($image['size'] <= $maxSize) {
                    $imageName = time() . '_' . basename($image['name']);
                    $uploadsDir = __DIR__ . '/../../public/uploads/';
                    $targetPath = $uploadsDir . $imageName;

                    FileHelper::ensureUploadsFolderExists($uploadsDir);

                    if (!move_uploaded_file($image['tmp_name'], $targetPath)) {
                        $_SESSION['message'] = [
                            'type' => 'error',
                            'text' => '❌ Gagal upload gambar.'
                        ];
                        header('Location: /dashboard/blog');
                        exit;
                    }
                } else {
                    $_SESSION['message'] = [
                        'type' => 'error',
                        'text' => '❌ Ukuran file tidak boleh lebih dari 1MB.'
                    ];
                    header('Location: /dashboard/blog');
                    exit;
                }
            } else {
                // Jika tidak upload gambar baru, ambil gambar lama
                $existingBlog = $blogModel->getBlogById($id);
                $imageName = $existingBlog['image'];
            }

            $success = $blogModel->updateBlog($id, $title, $description, $date, $author, $imageName);

            $_SESSION['message'] = $success
                ? ['type' => 'success', 'text' => '✅ Data blog berhasil diperbarui.']
                : ['type' => 'error', 'text' => '❌ Gagal memperbarui data blog.'];

            header('Location: /dashboard/blog');
            exit;
        }
    }

}
