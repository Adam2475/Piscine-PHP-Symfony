<?php

namespace ex08\Bundle\Service;

class TableService
{

    public function CreateTable($connection)
    {
        $sql = <<<SQL
           CREATE TABLE IF NOT EXISTS persons (
               id INT AUTO_INCREMENT PRIMARY KEY,
               username VARCHAR(255) UNIQUE NOT NULL,
               name VARCHAR(255) NOT NULL,
               email VARCHAR(255) UNIQUE NOT NULL,
               enable BOOLEAN NOT NULL DEFAULT TRUE,
               birthdate DATETIME NOT NULL
        );
SQL;
// the SQL ending must not have any space before it
        $int = $connection->query($sql);

        if (!$int)
            return 1;
        else
            return 0;
    }

    public function UpdateTable($connection)
    {
        $sql = <<<SQL
        ALTER TABLE persons 
        ADD COLUMN marital_status ENUM('single', 'married', 'widower') DEFAULT 'single'
SQL;
        $int = $connection->query($sql);

        if (!$int)
            return 1;
        else
            return 0;
    }

    public function CreateMoreTables($connection)
    {
        $sql = <<<SQL
           CREATE TABLE IF NOT EXISTS addresses (
               id INT AUTO_INCREMENT PRIMARY KEY,
               address VARCHAR(255) NOT NULL
        );
SQL;
        $sql2 = <<<SQL
           CREATE TABLE IF NOT EXISTS bank_accounts (
               id INT AUTO_INCREMENT PRIMARY KEY,
               account_num VARCHAR(255) NOT NULL
        );
SQL;
        $int = $connection->query($sql);
        $int2 = $connection->query($sql2);

        if (!$int || !$int2)
            return 1;
        else
            return 0;

    }

    public function CreateRelationships($connection)
    {
        // One-to-One: bank_accounts → persons
        $sql1 = <<<SQL
        ALTER TABLE bank_accounts
        ADD COLUMN person_id INT UNIQUE,
        ADD CONSTRAINT fk_bank_accounts_person
            FOREIGN KEY (person_id)
            REFERENCES persons(id)
            ON DELETE CASCADE;
SQL;

        // One-to-Many: addresses → persons
        $sql2 = <<<SQL
        ALTER TABLE addresses
        ADD COLUMN person_id INT,
        ADD CONSTRAINT fk_addresses_person
            FOREIGN KEY (person_id)
            REFERENCES persons(id)
            ON DELETE CASCADE;
SQL;

// on delete cascade only affect the deleting of the rows
// it doesn't affect tables

// for tables with costraints you need to drop related
// tables first

        $int1 = $connection->query($sql1);
        $int2 = $connection->query($sql2);

        if (!$int1 || !$int2)
            return 1;
        else
            return 0;
    }

    public function DeleteTables($connection)
    {
        $sql1 = <<<SQL
        drop table bank_accounts
SQL;
        $sql2 = <<<SQL
        drop table addresses
SQL;
        $sql3 = <<<SQL
        drop table persons
SQL;

        $int1 = $connection->query($sql1);
        $int2 = $connection->query($sql2);
        $int3 = $connection->query($sql3);

        if (!$int1 || !$int2 || !$int3)
            return 1;
        else
            return 0;
    }

}

?>