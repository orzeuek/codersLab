<?php

/**
 * @author Rafał Orłowski <rafal.orlowski@assertis.co.uk>
 */
class UsersFromDb
{

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function readAll()
    {
        $query = $this->pdo->prepare("SELECT id,user FROM users");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
}