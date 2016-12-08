<?php

require_once __DIR__."/../src/Users.php";

/**
 * @author Rafał Orłowski <rafal.orlowski@assertis.co.uk>
 */
class UsersTest extends PHPUnit_Extensions_Database_TestCase
{

    private $pdo;

    protected function getConnection()
    {
        if(empty($this->pdo)){
            $pdo = new PDO("sqlite::memory:");
            $pdo->exec("CREATE TABLE users(id, username);");
            $this->pdo = $pdo;
        }

        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($this->pdo, ':memory:');
    }

    protected function getDataSet()
    {
        $csvData = new PHPUnit_Extensions_Database_DataSet_CsvDataSet();
        $csvData->addTable('users', __DIR__."/fixtures/table.csv");

        return $csvData;
    }

    public function testGetAllUsers()
    {
        $users = new Users($this->pdo);
        $result = $users->getAll();

        $this->assertCount(2,$result);
        $this->assertEquals(["id"=>1, "username"=>"admin"],$result[0]);
        $this->assertEquals(["id"=>2, "username"=>"regular_user"],$result[1]);
    }

}