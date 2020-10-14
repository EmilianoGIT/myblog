<?php

class Category
{

    //DB stuff
    private $conn;
    private $table = 'categories';

    //Category properties
    public $id;
    public $name;
    public $created_at;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get categories
    public function read()
    {
        $query = 'SELECT 
        id,
        name
        FROM ' .$this->table. '
        ORDER BY created_at DESC
        ';

        //Prepared statement
        $stmt = $this->conn->prepare($query);

        //Execute query
        $stmt->execute();

        return $stmt;
    }

    //Read single category
    public function read_single()
    {
        //Create query
        $query = 'SELECT 
                id,
                name
                FROM 
                ' . $this->table . '
                WHERE id = ?
                LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(1, $this->id);

        //Execute the query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Set properties
        $this->id = $row['id'];
        $this->name = $row['name'];
    }

    //Create category
    public function create()
    {
    }

    //Update category
    public function update()
    {
    }

    //Delete category
    public function delete()
    {
    }
}
