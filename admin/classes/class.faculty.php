<?php

/**
* 
*/
class Faculty
{
	private $id;
	private $title;
	private $dean;
    private $abbr;

	public function create()
    {
        $conn = Database::getInstance();
        $sql = "INSERT INTO faculties
                SET
                title=:title, dean=:dean, abbr=:abbr";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":dean", $this->dean);
        $stmt->bindParam(":abbr", $this->abbr);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function update()
    {
        $conn = Database::getInstance();
        $sql = 'UPDATE faculties
                SET
                title=:title, dean=:dean, abbr=:abbr
                WHERE id=' . $this->id;

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":dean", $this->dean);
        $stmt->bindParam(":abbr", $this->abbr);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function delete()
    {
        $conn = Database::getInstance();

        $sql = "DELETE FROM faculties WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $this->id);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;

    }

    public static function getFacultyByID($id){
    	$conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM faculties WHERE id = {$id}");
        $stmt->execute();

        $result = $stmt->fetch();

        $tempObj = new Faculty();

        $tempObj->id = $result['id'];
        $tempObj->title = $result['title'];
        $tempObj->dean = $result['dean'];
        $tempObj->abbr = $result['abbr'];

        $conn = null;
        return $tempObj;
    }

    public static function readAll()
    {
    	$conn = Database::getInstance();

    	$sql = "SELECT * FROM faculties";
    	$results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($faculty = $results->fetch()) {
                $tempObj = new Faculty();

                $tempObj->id = $faculty['id'];
                $tempObj->title = $faculty['title'];
                $tempObj->dean = $faculty['dean'];
                $tempObj->abbr = $faculty['abbr'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getAllFacultyAbbrList()
    {
        $conn = Database::getInstance();

        $sql = "SELECT id, abbr FROM faculties";
        $results = $conn->query($sql);

        $returnArr = array();

        while ($faculty = $results->fetch()) {
            $returnArr[$faculty['id']] = $faculty['abbr'];
        }

        return $returnArr;
    }

    public static function findStaffFaculty($staffID)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM faculties WHERE dean = $staffID";
        $result = $conn->query($sql)->fetch();

        return $result;
    }

	public function getID(){
		return $this->id;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getDean(){
		return $this->dean;
	}

	public function setDean($dean){
		$this->dean = $dean;
	}

    public function getAbbr()
    {
        return $this->abbr;
    }

    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;
    }
}