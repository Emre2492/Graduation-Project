<?php
/**
 * 
 */
class Announce
{
	private $id;
	private $title;
	private $content;
	private $annTo;
	private $created;

	public function create()
	{
		$conn = Database::getInstance();
		$sql = "INSERT INTO announces SET
				title=:title, content=:content, annTo=:annTo";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":title", $this->title);
		$stmt->bindParam(":content", $this->content);
		$stmt->bindParam(":annTo", $this->annTo);

		$stmt->execute();
		$conn = null;
	}

	public function update()
	{
		$conn = Database::getInstance();
		$sql = "UPDATE announces SET
				title=:title, content=:content, annTo=:annTo
				WHERE id=:id";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":title", $this->title);
		$stmt->bindParam(":content", $this->content);
		$stmt->bindParam(":annTo", $this->annTo);
		$stmt->bindParam(":id", $this->id);

		$stmt->execute();
		$conn = null;
	}

	public function delete()
	{
		$conn = Database::getInstance();
		$sql = "DELETE FROM announces WHERE id=" . $this->id;
		$conn->execute($sql);
		$conn = null;
	}

	public static function getAnnouncesByKey($key, $limit)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM announces WHERE annTo=:annTo ORDER BY id DESC";

		if ($limit != null) 
			$sql .= " LIMIT $limit";

		
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":annTo", $key);
		$stmt->execute();

		$returnArr = array();

        try {
            while ($ann = $stmt->fetch()) {
                $tempObj = new Announce();

                $tempObj->id = $ann['id'];
                $tempObj->title = $ann['title'];
                $tempObj->content = $ann['content'];
                $tempObj->annTo = $ann['annTo'];
                $tempObj->created = $ann['created'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
	}

	public static function getAnnounceByID($id)
	{
		$conn = Database::getInstance();
		$sql = "SELECT * FROM announces WHERE id = $id";
		$ann = $conn->query($sql)->fetch();

		$tempObj = new Announce();
		$tempObj->id = $ann['id'];
        $tempObj->title = $ann['title'];
        $tempObj->content = $ann['content'];
        $tempObj->annTo = $ann['annTo'];
        $tempObj->created = $ann['created'];

		return $tempObj;
	}

	public static function readAll()
	{	
		$conn = Database::getInstance();
		$sql = "SELECT * FROM announces ORDER BY id DESC";

		$stmt = $conn->prepare($sql);
		$stmt->bindParam(":annTo", $key);
		$stmt->execute();

		$returnArr = array();

        try {
            while ($ann = $stmt->fetch()) {
                $tempObj = new Announce();

                $tempObj->id = $ann['id'];
                $tempObj->title = $ann['title'];
                $tempObj->content = $ann['content'];
                $tempObj->annTo = $ann['annTo'];
                $tempObj->created = $ann['created'];

                array_push($returnArr, $tempObj);
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

	public function getAnnTo(){
		return $this->annTo;
	}

	public function setAnnTo($annTo){
		$this->annTo = $annTo;
	}

	public function getCreated(){
		return $this->created;
	}
}