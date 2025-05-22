<?php

namespace App\Model;

use PDO;

class BlogModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllBlogs()
    {
        $stmt = $this->pdo->query("SELECT * FROM blogs ORDER BY date DESC");
        return $stmt->fetchAll();
    }

    public function getBlogById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM blogs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createBlog($title, $description, $date, $author, $image)
    {
        $stmt = $this->pdo->prepare("INSERT INTO blogs (title, description, date, author, image) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $date, $author, $image]);
    }

    public function updateBlog($id, $title, $description, $date, $author, $image)
    {
        $stmt = $this->pdo->prepare("UPDATE blogs SET title = ?, description = ?, date = ?, author = ?, image = ? WHERE id = ?");
        return $stmt->execute([$title, $description, $date, $author, $image, $id]);
    }

    public function deleteBlog($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM blogs WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
