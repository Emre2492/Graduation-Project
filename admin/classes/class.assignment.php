<?php

/**
 * 
 */
class Assignment
{
	private $id;
	private $title;
	private $content;
	private $dueDate;
	private $lecCode;

	public function create()
	{
		$conn = Database::getInstance();
		$sql = "INSERT INTO assignments
				SET
				title=:title, content=:content, dueDate=:dueDate, lecCode=:lecCode";
		
		$stmt = $conn->prepare($sql);

		$stmt->bindParam(":title", $this->title);
		$stmt->bindParam(":content", $this->content);
		$stmt->bindParam(":dueDate", $this->dueDate);
		$stmt->bindParam(":lecCode", $this->lecCode);

		$stmt->execute();
		$conn = null;
	}

	public function update()
	{
		$conn = Database::getInstance();
		$sql = "UPDATE assignments
				SET
				title=:title, content=:content, dueDate=:dueDate, lecCode=:lecCode
				WHERE
				id=:id";
		
		$stmt = $conn->prepare($sql);

		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":title", $this->title);
		$stmt->bindParam(":content", $this->content);
		$stmt->bindParam(":dueDate", $this->dueDate);
		$stmt->bindParam(":lecCode", $this->lecCode);

		$stmt->execute();
		$conn = null;
	}

	public function delete()
	{
		$conn = Database::getInstance();
		$sql = "DELETE FROM assignments WHERE id=" . $this->id;
		$conn->query($sql);
		$conn = null;
	}

	public static function getAssignmentsByLecCode($lecCode)
	{
		$conn = Database::getInstance();
		$returnArr = array();

		$sql = "SELECT * FROM assignments WHERE lecCode=:lecCode";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":lecCode", $lecCode);
		$stmt->execute();

		try {
            while ($assignment = $stmt->fetch()) {
                $tempObj = new Assignment();

                $tempObj->id = (int)$assignment['id'];
                $tempObj->title = $assignment['title'];
                $tempObj->content = $assignment['content'];
                $tempObj->dueDate = $assignment['dueDate'];
                $tempObj->lecCode = $assignment['lecCode'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
	}

	public static function getAssignmentsByID($id)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM assignments WHERE id = $id";
		$assignment = $conn->query($sql)->fetch();

        $tempObj = new Assignment();

        $tempObj->id = (int)$assignment['id'];
        $tempObj->title = $assignment['title'];
        $tempObj->content = $assignment['content'];
        $tempObj->dueDate = $assignment['dueDate'];
        $tempObj->lecCode = $assignment['lecCode'];

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

	public function getContent(){
		return $this->content;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function getDueDate(){
		return $this->dueDate;
	}

	public function setDueDate($dueDate){
		$this->dueDate = $dueDate;
	}

	public function getLecCode(){
		return $this->lecCode;
	}

	public function setLecCode($lecCode){
		$this->lecCode = $lecCode;
	}
}