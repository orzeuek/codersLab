<?php

require_once __DIR__."/../src/UsersFromDb.php";

class DbUnitTest extends PHPUnit_Extensions_Database_TestCase
{

    private $pdo;

    /**
     * Returns the test database connection.
     *
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        if(empty($this->pdo)){
            $this->pdo = new PDO;
            $this->pdo->exec("CREATE TABLE users(id, user);");
        }

        return $this->createDefaultDBConnection($this->pdo, ':memory:');
    }

    /**
     * Returns the test dataset.
     *
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        $csv_data_set = new PHPUnit_Extensions_Database_DataSet_CsvDataSet();
        $csv_data_set->addTable('users', __DIR__.'/fixtures/table.csv');

        return $csv_data_set;
    }

    public function testGetAll()
    {
        $objectUnderTest = new UsersFromDb($this->getConnection()->getConnection());
        $result = $objectUnderTest->readAll();

        $this->assertCount(2, $result);
        $this->assertEquals("admin", $result[0]['user']);
        $this->assertEquals("regular_user", $result[1]['user']);
    }
}