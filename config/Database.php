<?php


class Database
{
    //DB parameters
    private $host = 'localhost';
    private $db_name = 'myblog';
    private $username = 'root';
    private $password = 'password';
    private $conn;

    //DB connect
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);

            //I want to be able to get the exceptions when I make queries so that it'll tell us something
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Connection Error' . $e->getMessage();
        }

        return $this->conn;
    }
}
