<?php

/**
 *
 */
class Message
{
    private $id;
    private $messageFrom;
    private $messageTo;
    private $content;
    private $timestamp;
    private $status;

    public function create()
    {
        $conn = Database::getInstance();
        $sql = "INSERT INTO messages
                SET
                messageFrom=:messageFrom, messageTo=:messageTo, content=:content, status=0";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":messageFrom", $this->messageFrom);
        $stmt->bindParam(":messageTo", $this->messageTo);
        $stmt->bindParam(":content", $this->content);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function update()
    {
        $conn = Database::getInstance();
        $sql = "UPDATE messages
                SET
                messageFrom=:messageFrom, messageTo=:messageTo, content=:content, timestamp=:timestamp, status=:status
                WHERE id=" . $this->id;

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":messageFrom", $this->messageFrom);
        $stmt->bindParam(":messageTo", $this->messageTo);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":timestamp", $this->timestamp);
        $stmt->bindParam(":status", $this->status);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function delete()
    {
        $conn = Database::getInstance();
        $sql = "DELETE FROM messages WHERE id=:id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":id", $this->id);

        $feedback = $stmt->execute();
        $conn = null;

        return $feedback;
    }

    public static function getUnreadMessageCount()
    {
        $conn = Database::getInstance();
        $userID = $_SESSION['id'];

        $sql = "SELECT NULL FROM messages WHERE messageTo=:userID AND status=0";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":userID", $userID);
        $stmt->execute();

        $conn = null;
        return $stmt->rowCount();
    }

    public static function getGrouppedMessageList()
    {
        $conn = Database::getInstance();
        $userID = $_SESSION['id'];
        $returnArr = array();

        $sql = "SELECT * FROM messages WHERE messageTo=$userID GROUP BY messageFrom ORDER BY timestamp";
        $results = $conn->query($sql);

        try {
            while ($message = $results->fetch()) {
                $tempObj = new Message();

                $tempObj->id = (int)$message['id'];
                $tempObj->messageFrom = $message['messageFrom'];
                $tempObj->messageTo = $message['messageTo'];
                $tempObj->content = $message['content'];
                $tempObj->timestamp = $message['timestamp'];
                $tempObj->status = $message['status'];

                array_push($returnArr, $tempObj);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getConversationWith($from)
    {
        $conn = Database::getInstance();
        $userID = $_SESSION['id'];
        $returnArr = array();

        $sql = "SELECT * FROM messages WHERE messageTo=$userID AND messageFrom=$from OR messageTo=$from AND messageFrom=$userID";
        $results = $conn->query($sql);

        try {
            while ($message = $results->fetch()) {
                $tempObj = new Message();

                $tempObj->id = (int)$message['id'];
                $tempObj->messageFrom = $message['messageFrom'];
                $tempObj->messageTo = $message['messageTo'];
                $tempObj->content = $message['content'];
                $tempObj->timestamp = $message['timestamp'];
                $tempObj->status = $message['status'];

                array_push($returnArr, $tempObj);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function changeStatus($from)
    {
        $conn = Database::getInstance();
        $userID = $_SESSION['id'];

        $sql = "UPDATE messages
                SET
                status=1
                WHERE messageFrom=$from and messageTo=$userID";
        $conn->query($sql);
    }

    public function getID(){
		return $this->id;
	}

	public function getMessageFrom(){
		return $this->messageFrom;
	}

	public function setMessageFrom($messageFrom){
		$this->messageFrom = $messageFrom;
	}

	public function getMessageTo(){
		return $this->messageTo;
	}

	public function setMessageTo($messageTo){
		$this->messageTo = $messageTo;
	}

	public function getContent(){
		return $this->content;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function getTimestamp(){
		return $this->timestamp;
	}

	public function setTimestamp($timestamp){
		$this->timestamp = $timestamp;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}
}
