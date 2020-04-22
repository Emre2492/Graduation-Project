<?php

class Book
{
    private $id;
    private $isbn;
    private $title;
    private $author;
    private $publisher;

    public function create()
    {
    	$conn = Database::getInstance();
        $sql = "INSERT INTO books
                SET
                isbn=:isbn, title=:title, author=:author, publisher=:publisher";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":publisher", $this->publisher);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function update()
    {
    	$conn = Database::getInstance();
        $sql = "UPDATE books
                SET
                isbn=:isbn, title=:title, author=:author, publisher=:publisher
                WHERE id=" . $this->id;

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":isbn", $this->isbn);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":publisher", $this->publisher);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function delete()
    {
    	$conn = Database::getInstance();
        $sql = "DELETE FROM books WHERE id=:id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":id", $this->id);

        $feedback = $stmt->execute();
        $conn = null;

        return $feedback;
    }

    public static function getBookByID($id)
    {
    	$conn = Database::getInstance();
        $sql = "SELECT * FROM books WHERE id=$id";

        $result = $conn->query($sql)->fetch();

        $tempObj = new Book();

        $tempObj->id = $result['id'];
        $tempObj->isbn = $result['isbn'];
        $tempObj->title = $result['title'];
        $tempObj->author = $result['author'];
        $tempObj->publisher = $result['publisher'];

        $conn = null;
        return $tempObj;
    }

    public static function getBooksByISBN($isbn)
    {
    	$conn = Database::getInstance();
        $sql = "SELECT * FROM books WHERE isbn=$isbn";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($book= $results->fetch()) {
                $tempObj = new Book();

                $tempObj->id = $book['id'];
                $tempObj->isbn = $book['isbn'];
                $tempObj->title = $book['title'];
                $tempObj->author = $book['author'];
                $tempObj->publisher = $book['publisher'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function search($query)
    {
    	$conn = Database::getInstance();
        $sql = "SELECT * FROM books WHERE title LIKE '%" . $query . "%' OR isbn LIKE '" . $query . "%'";
        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($book= $results->fetch()) {
                $tempObj = new Book();

                $tempObj->id = $book['id'];
                $tempObj->isbn = $book['isbn'];
                $tempObj->title = $book['title'];
                $tempObj->author = $book['author'];
                $tempObj->publisher = $book['publisher'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function isRented($bookID)
    {
        $conn = Database::getInstance();
        $sql = "SELECT COUNT(*) FROM book_rental WHERE bookID=$bookID";

        $result = $conn->query($sql)->fetchColumn();
        $conn = null;
        
        if ($result > 0)
            return true;
        else
            return false;
    }

    public static function getRentedBooksList()
    {
        $conn = Database::getInstance();
        $sql = "SELECT bookID FROM book_rental";
        $results = $conn->query($sql);
        $returnArr = array();

        foreach ($results as $book) {
            $returnArr[] = $book['bookID'];
        }
        return $returnArr;
    }

    public static function getDetailedRentedInfo($id)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM book_rental WHERE bookID=$id";
        $result = $conn->query($sql)->fetch();

        return $result;
    }

    public static function getLastBooks($amount)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM books ORDER BY id DESC LIMIT $amount";
        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($book= $results->fetch()) {
                $tempObj = new Book();

                $tempObj->id = $book['id'];
                $tempObj->isbn = $book['isbn'];
                $tempObj->title = $book['title'];
                $tempObj->author = $book['author'];
                $tempObj->publisher = $book['publisher'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function bookRentalOperations($userEmail, $bookID, $returnDate, $type)
    {
        $sql = "";

        switch ($type) {
            case 'rent':
                $sql = "INSERT INTO book_rental SET bookID=$bookID, userEmail='$userEmail', returnDate='$returnDate'";
                break;

            case 'return':
                $sql = "DELETE FROM book_rental WHERE bookID=$bookID";
                break;
            
            default:
                break;
        }

        $conn = Database::getInstance();
        $conn->query($sql);
        $conn = null;
    }

    public function getID(){
		return $this->id;
	}

	public function getISBN(){
		return $this->isbn;
	}

	public function setISBN($isbn){
		$this->isbn = $isbn;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getAuthor(){
		return $this->author;
	}

	public function setAuthor($author){
		$this->author = $author;
	}

	public function getPublisher(){
		return $this->publisher;
	}

	public function setPublisher($publisher){
		$this->publisher = $publisher;
	}
}