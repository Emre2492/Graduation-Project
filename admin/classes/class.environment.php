<?php

/**
 * 
 */
class Environment
{
	private $id;
	private $title;
	private $lectureCode;
	private $path;

	public function create()
	{
		$conn = Database::getInstance();
        $sql = "INSERT INTO lecture_environments
                SET
                title=:title, lectureCode=:lectureCode, path=:path";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":lectureCode", $this->lectureCode);
        $stmt->bindParam(":path", $this->path);

        $stmt->execute();

        $conn = null;
	}

	public function update()
	{
		$conn = Database::getInstance();
        $sql = "UPDATE lecture_environments
                SET
                title=:title, lectureCode=:lectureCode, path=:path
                WHERE id=" . $this->id;

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":lectureCode", $this->lectureCode);
        $stmt->bindParam(":path", $this->path);

		$stmt->execute();

        $conn = null;
	}

	public function delete()
	{
		$conn = Database::getInstance();
		$sql = "DELETE FROM lecture_environments WHERE id=" . $this->id;

		$conn->query($sql);
		$conn = null;
	}

	public static function getEnvByLecCode($lecCode)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM lecture_environments WHERE lectureCode = '$lecCode'";
		$results = $conn->query($sql);

		$returnArr = array();

        try {
            while ($result = $results->fetch()) {
                $tempObj = new Environment();

                $tempObj->id = $result['id'];
                $tempObj->title = $result['title'];
                $tempObj->lectureCode = $result['lectureCode'];
                $tempObj->path = $result['path'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;	
	}

	public static function getEnvByID($id)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM lecture_environments WHERE id=$id";
		$result = $conn->query($sql)->fetch();

        $tempObj = new Environment();

        $tempObj->id = $result['id'];
        $tempObj->title = $result['title'];
        $tempObj->lectureCode = $result['lectureCode'];
        $tempObj->path = $result['path'];

        $conn = null;
        return $tempObj;	
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

	public function getLectureCode(){
		return $this->lectureCode;
	}

	public function setLectureCode($lectureCode){
		$this->lectureCode = $lectureCode;
	}

	public function getPath(){
		return $this->path;
	}

	public function setPath($path){
		$this->path = $path;
	}
}