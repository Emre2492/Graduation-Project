<?php

/**
 * 
 */
class Stuassignment
{
	private $id;
	private $student;
	private $assignment;
	private $file;
	private $timestamp;
	private $grade;

	public function create()
	{
		$conn = Database::getInstance();
		$sql = "INSERT INTO stu_assignments
				SET
				student=:student, assignment=:assignment, file=:file";

		$stmt = $conn->prepare($sql);

		$stmt->bindParam(":student", $this->student);
		$stmt->bindParam(":assignment", $this->assignment);
		$stmt->bindParam(":file", $this->file);

		$stmt->execute();
		$conn = null;
	}

	public function update()
	{
		$conn = Database::getInstance();
		$sql = "UPDATE stu_assignments
				SET
				student=:student, assignment=:assignment, file=:file, grade=:grade
				WHERE id=" . $this->id;

		$stmt = $conn->prepare($sql);

		$stmt->bindParam(":student", $this->student);
		$stmt->bindParam(":assignment", $this->assignment);
		$stmt->bindParam(":file", $this->file);
		$stmt->bindParam(":grade", $this->grade);

		$stmt->execute();
		$conn = null;
	}

	public function delete()
	{
		$conn = Database::getInstance();
		$sql = "DELETE FROM stu_assignments
				WHERE id=" . $this->id;
		$conn->query($sql);
		$conn = null;
	}

	public static function getStudentAssignmentsByAssignmentID($id)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM stu_assignments WHERE assignment=$id";
		$results = $conn->query($sql);
		$returnArr = array();

		try {
            while ($assignment = $results->fetch()) {
                $tempObj = new Stuassignment();

                $tempObj->id = (int)$assignment['id'];
                $tempObj->student = $assignment['student'];
                $tempObj->assignment = $assignment['assignment'];
                $tempObj->file = $assignment['file'];
                $tempObj->timestamp = $assignment['timestamp'];
                $tempObj->grade = $assignment['grade'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
	}

	public static function getAssignmentByID($id)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM stu_assignments WHERE id=$id";
		$result = $conn->query($sql)->fetch();

		$tempObj = new Stuassignment();
		$tempObj->id = $result['id'];
		$tempObj->student = $result['student'];
		$tempObj->assignment = $result['assignment'];
		$tempObj->file = $result['file'];
        $tempObj->timestamp = $result['timestamp'];
        $tempObj->grade = $result['grade'];

        return $tempObj;
	}

	public static function isAlreadySent($assignment, $student)
	{
		$conn = Database::getInstance();
		$sql = "SELECT COUNT(*) FROM stu_assignments WHERE assignment=$assignment AND student=$student";
		$result = $conn->query($sql)->fetchColumn();

		return $result > 0;
	}

	public static function getStuGrades($student)
	{
		$conn = Database::getInstance();
		$sql = "SELECT sa.id, sa.grade, assign.lecCode, assign.title 
				FROM stu_assignments AS sa
				INNER JOIN assignments as assign
					ON assign.id = sa.assignment 
				WHERE student=$student";
		$results = $conn->query($sql);
		$returnArr = array();

		try {
            while ($assignment = $results->fetch()) {
                $returnArr[$assignment['id']]['id'] = $assignment['id'];
                $returnArr[$assignment['id']]['grade'] = $assignment['grade'];
                $returnArr[$assignment['id']]['lecCode'] = $assignment['lecCode'];
                $returnArr[$assignment['id']]['title'] = $assignment['title'];
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
	}

	public function getID(){
		return $this->id;
	}

	public function getStudent(){
		return $this->student;
	}

	public function setStudent($student){
		$this->student = $student;
	}

	public function getAssignment(){
		return $this->assignment;
	}

	public function setAssignment($assignment){
		$this->assignment = $assignment;
	}

	public function getFile(){
		return $this->file;
	}

	public function setFile($file){
		$this->file = $file;
	}

	public function getTimestamp(){
		return $this->timestamp;
	}

	public function setTimestamp($timestamp){
		$this->timestamp = $timestamp;
	}

	public function getGrade(){
		return $this->grade;
	}

	public function setGrade($grade){
		$this->grade = $grade;
	}
}