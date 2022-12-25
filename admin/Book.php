<?php

require_once "db/db.php";



class Book{

    public $table = 'book';

    private $title;
    private $description;
    private $writer;
    private $genre;
    private $price;
    private $file;


    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setWriter($writer)
    {
        $this->writer = $writer;
    }
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setFile($file)
    {
        $this->file = $file;
    }

    public function insertData()
    {
        $sql = "INSERT INTO $this->table(title, description, writer, genre, price, file) VALUES(:title, :description, :writer, :genre, :price, :file)";
        $stmt = DB::prepareOwn($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":writer", $this->writer);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":file", $this->file);

        return $stmt->execute();
    }

    public function readAll()
    {

        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        }
        else {
            $page=1;
        }
        $per_page_record = 3;
        $start_from = ($page-1) * $per_page_record;
        $sql = "SELECT * FROM $this->table LIMIT $start_from, $per_page_record";
        $stmt = DB::prepareOwn($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function read_index()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = DB::prepareOwn($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function UpdateData($id)
    {
        $sql = "UPDATE $this->table SET title=:title, description=:description, writer=:writer, genre=:genre, price=:price, file=:file WHERE id=:id";
        $stmt = DB::prepareOwn($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":writer", $this->writer);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":file", $this->file);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id=:id";
        $stmt = DB::prepareOwn($sql);

        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteData($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=:id";
        $stmt = DB::prepareOwn($sql);

        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function deleteAll()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "books_db";

            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM book";
            $conn->exec($sql);

        $conn = null;
    }

}

