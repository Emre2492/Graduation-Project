<?php
/**
 * 
 */
class Pollanswer
{
	private $id;
	private $title;
	private $pollID;
	private $one;
	private $two;
	private $three;
	private $four;
	private $five;

	public function create()
	{
		$conn = Database::getInstance();
		$sql = "INSERT INTO poll_questions
				SET
				title=:title, pollID=:pollID";

		$stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":pollID", $this->pollID);

        $stmt->execute();
        $conn = null;
	}

	public function update()
	{
		$conn = Database::getInstance();
		$sql = "UPDATE poll_questions
				SET
				one=:one, two=:two, three=:three, four=:four, five=:five
				WHERE
				id=" . $this->id;

		$stmt = $conn->prepare($sql);

        $stmt->bindParam(":one", $this->one);
        $stmt->bindParam(":two", $this->two);
        $stmt->bindParam(":three", $this->three);
        $stmt->bindParam(":four", $this->four);
        $stmt->bindParam(":five", $this->five);

        $stmt->execute();
        $conn = null;
	}

	public static function getAnswersByPollID($id)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM poll_questions WHERE pollID=" . $id;
		$results = $conn->query($sql);

		$returnArr = array();

		while ($ans = $results->fetch()) {
			$tempObj = new Pollanswer();
			$tempObj->id = $ans['id'];
			$tempObj->title = $ans['title'];
			$tempObj->pollID = $ans['pollID'];
			$tempObj->one = $ans['one'];
			$tempObj->two = $ans['two'];
			$tempObj->three = $ans['three'];
			$tempObj->four = $ans['four'];
			$tempObj->five = $ans['five'];

			$returnArr[] = $tempObj;
		}

		$conn = null;
		return $returnArr;
	}

	public function delete()
	{
		$conn = Database::getInstance();
		$sql = "DELETE FROM poll_questions WHERE id=" . $this->id;
		$conn->query($sql);
		$conn = null;
	}

	public static function upVote($id, $column)
	{
		$conn = Database::getInstance();
		$sql = "UPDATE poll_questions
				SET
				$column = $column + 1
				WHERE id = $id";
		$conn->query($sql);
		$conn = null;
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

	public function getPollID(){
		return $this->pollID;
	}

	public function setPollID($pollID){
		$this->pollID = $pollID;
	}

	public function getOne(){
		return $this->one;
	}

	public function setOne($one){
		$this->one = $one;
	}

	public function getTwo(){
		return $this->two;
	}

	public function setTwo($two){
		$this->two = $two;
	}

	public function getThree(){
		return $this->three;
	}

	public function setThree($three){
		$this->three = $three;
	}

	public function getFour(){
		return $this->four;
	}

	public function setFour($four){
		$this->four = $four;
	}

	public function getFive(){
		return $this->five;
	}

	public function setFive($five){
		$this->five = $five;
	}
}