<?php
/**
 * 
 */
class Logger
{
	private $conn;
	private $logID;
	private $logType;
	private $user;
	private $userType;
	private $event;
	private $eventTime;

	
	function __construct()
	{
		$this->conn = Database::getInstance();
	}

	public function log($logType, $user, $userType, $event)
	{
		$sql = "INSERT INTO logs 
				SET
				logType=:logType, user=:user, userType=:userType, event=:event";

		$stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":logType", $logType);
        $stmt->bindParam(":user", $user);
        $stmt->bindParam(":userType", $userType);
        $stmt->bindParam(":event", $event);

		$stmt->execute();
	}

	function __destruct() {
        $this->conn = null;
    }
}