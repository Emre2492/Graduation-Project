<?php

/**
* 
*/
class Department
{
	private $id;
	private $title;
	private $chair;
	private $faculty;
    private $abbr;

	public function create()
    {
        $conn = Database::getInstance();
        $sql = "INSERT INTO departments
                SET
                title=:title, chair=:chair, faculty=:faculty, abbr=:abbr";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":chair", $this->chair);
        $stmt->bindParam(":faculty", $this->faculty);
        $stmt->bindParam(":abbr", $this->abbr);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function update()
    {
        $conn = Database::getInstance();
        $sql = 'UPDATE departments
                SET
                title=:title, chair=:chair, faculty=:faculty, abbr=:abbr
                WHERE id=' . $this->id;

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":chair", $this->chair);
        $stmt->bindParam(":faculty", $this->faculty);
        $stmt->bindParam(":abbr", $this->abbr);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function delete()
    {
        $conn = Database::getInstance();

        $sql = "DELETE FROM departments WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $this->id);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;

    }

    public static function getDepartmentByID($id){
    	$conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM departments WHERE id = {$id}");
        $stmt->execute();

        $result = $stmt->fetch();

        $tempObj = new Department();

        $tempObj->id = (int)$result['id'];
        $tempObj->title = $result['title'];
        $tempObj->chair = $result['chair'];
        $tempObj->faculty = $result['faculty'];
        $tempObj->abbr = $result['abbr'];

        $conn = null;
        return $tempObj;
    }

    public static function getDepartmentsByFacultyID($facultyID)
    {
    	$conn = Database::getInstance();

    	$sql = "SELECT * FROM departments WHERE faculty = {$facultyID}";
    	$stmt = $conn->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetch();

        $returnArr = array();

        try {
            while ($department = $results->fetch()) {
                $tempObj = new Department();

                $tempObj->id = (int)$department['id'];
        		$tempObj->title = $department['title'];
        		$tempObj->chair = $department['chair'];
        		$tempObj->faculty = $department['faculty'];
                $tempObj->abbr = $department['abbr'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function readAll()
    {
    	$conn = Database::getInstance();

    	$sql = "SELECT * FROM departments";
    	$results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($department = $results->fetch()) {
                $tempObj = new Department();

                $tempObj->id = (int)$department['id'];
        		$tempObj->title = $department['title'];
        		$tempObj->chair = $department['chair'];
        		$tempObj->faculty = $department['faculty'];
                $tempObj->abbr = $department['abbr'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function findStaffDepartment($staffID)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM departments WHERE chair = $staffID";
        $result = $conn->query($sql)->fetch();

        return $result;
    }

    public static function getAllDepartmentAbbrList()
    {
        $conn = Database::getInstance();

        $sql = "SELECT id, abbr FROM departments";
        $results = $conn->query($sql);

        $returnArr = array();

        while ($faculty = $results->fetch()) {
            $returnArr[$faculty['id']] = $faculty['abbr'];
        }

        return $returnArr;
    }

    public static function readDeanDepartments($deanID) 
    {
        $conn = Database::getInstance();
        $sql = "SELECT d.id, d.title, d.abbr, d.chair, d.faculty FROM departments as d
                INNER JOIN faculties
                    ON faculties.id = d.faculty
                WHERE faculties.dean = $deanID";

        $results = $conn->query($sql);
        $returnArr = array();

        while ($department = $results->fetch()) {
            $tempObj = new Department();

            $tempObj->id = (int)$department['id'];
            $tempObj->title = $department['title'];
            $tempObj->chair = $department['chair'];
            $tempObj->faculty = $department['faculty'];
            $tempObj->abbr = $department['abbr'];

            array_push($returnArr, $tempObj);
        }

        $conn = null;
        return $returnArr;
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

	public function getChair(){
		return $this->chair;
	}

	public function setChair($chair){
		$this->chair = $chair;
	}

	public function getFaculty(){
		return $this->faculty;
	}

	public function setFaculty($faculty){
		$this->faculty = $faculty;
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