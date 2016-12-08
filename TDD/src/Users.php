<?php


class Users
{

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $query = $this->pdo->prepare("SELECT id, username FROM `users`;");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}