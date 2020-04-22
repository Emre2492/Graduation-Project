<?php
/**
 * 
 */
class Poll
{
	private $id;
	private $title;
	private $pollTo;

	public function create()
	{
		$conn = Database::getInstance();
		$sql = "INSERT INTO polls
				SET
				title=:title, pollTo=:pollTo";

		$stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":pollTo", $this->pollTo);

        $stmt->execute();
        $id = $conn->lastInsertId();

        $conn = null;
        return $id;
	}

	public function delete()
	{
		$conn = Database::getInstance();
		$sql = "DELETE FROM polls WHERE id=" . $this->id;
		$conn->query($sql);
		$conn = null;
	}

	public static function readAll()
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM polls";
		$results = $conn->query($sql);

		$returnArr = array();

		while ($poll = $results->fetch()) {
			$tempObj = new Poll();
			$tempObj->id = $poll['id'];
			$tempObj->title = $poll['title'];
			$tempObj->pollTo = $poll['pollTo'];

			array_push($returnArr, $tempObj);
		}

		$conn = null;
		return $returnArr;
	}

	public static function search($query)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM polls WHERE pollTo='" . $query . "'";
		$results = $conn->query($sql);

		$returnArr = array();

		while ($poll = $results->fetch()) {
			$tempObj = new Poll();
			$tempObj->id = $poll['id'];
			$tempObj->title = $poll['title'];
			$tempObj->pollTo = $poll['pollTo'];

			array_push($returnArr, $tempObj);
		}

		$conn = null;
		return $returnArr;
	}

	public static function getPollByID($id)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM polls WHERE id=" . $id;
		$result = $conn->query($sql)->fetch();

		$tempObj = new Poll();
		$tempObj->id = $result['id'];
		$tempObj->title = $result['title'];
		$tempObj->pollTo = $result['pollTo'];

		$conn = null;
		return $tempObj;
	}

	public static function professorsPolls($id)
	{
		$conn = Database::getInstance();
		$sql = "SELECT polls.id, polls.title, polls.pollTo
				FROM polls
				INNER JOIN lectures
					ON lectures.lecCode = polls.pollTo
				WHERE lectures.professor = $id";
		$results = $conn->query($sql);

		$returnArr = array();

		while ($poll = $results->fetch()) {
			$tempObj = new Poll();
			$tempObj->id = $poll['id'];
			$tempObj->title = $poll['title'];
			$tempObj->pollTo = $poll['pollTo'];

			array_push($returnArr, $tempObj);
		}

		$conn = null;
		return $returnArr;
	}

	public static function lecturePolls($lecCode)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM polls WHERE pollTo = '$lecCode'";
		$results = $conn->query($sql);

		$returnArr = array();

		while ($poll = $results->fetch()) {
			$tempObj = new Poll();
			$tempObj->id = $poll['id'];
			$tempObj->title = $poll['title'];
			$tempObj->pollTo = $poll['pollTo'];

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

	public function getPollTo(){
		return $this->pollTo;
	}

	public function setPollTo($pollTo){
		$this->pollTo = $pollTo;
	}
}