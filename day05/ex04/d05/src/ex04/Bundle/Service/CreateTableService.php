<?php

namespace ex04\Bundle\Service;

class CreateTableService
{
    public function createTable()
    {
        $host = 'localhost';
        $user = 'symfony_user';
        $password = 'symfony123';
        $database = 'symfony_ex00';

        $mysqli = new \mysqli($host, $user, $password, $database);

        $sql = "CREATE TABLE IF NOT EXISTS users_ex04 (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            enable BOOLEAN NOT NULL,
            birthdate DATETIME NOT NULL,
            address LONGTEXT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        // DB table creation
        try {
            $mysqli->query($sql);
            echo "Table 'users' created or already exists.";
        } catch (\Exception $e) {
            echo "Error creating table: " . $e->getMessage();
        }
        return $mysqli;
    }

    public function addTestUser($mysqli)
    {
        $query = $mysqli->prepare(
            "INSERT IGNORE INTO users_ex04 
            (username, name, email, enable, birthdate, address) 
            VALUES ('testUser', 'test', 'test@gmail.com', false, '22-12-1999', 'via morta22')"
        );
        if (!$query) {
            throw new \Exception("Prepare failed: " . $mysqli->error);
        }
        echo $query->execute();
        return 0;
    }
}


?>