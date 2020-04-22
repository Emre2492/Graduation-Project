<?php

/**
 *
 */
class Appointment
{
    private $id;
    private $rowIndex;
    private $columnIndex;
    private $userEmail;
    private $roomNum;

    public function create()
    {
        $conn = Database::getInstance();
        $sql = "INSERT INTO appointments
                SET
                rowIndex=:rowIndex, columnIndex=:columnIndex, userEmail=:userEmail, roomNum=:roomNum";
        
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":rowIndex", $this->rowIndex);
        $stmt->bindParam(":columnIndex", $this->columnIndex);
        $stmt->bindParam(":userEmail", $this->userEmail);
        $stmt->bindParam(":roomNum", $this->roomNum);

        $feedback = $stmt->execute();

        $conn = null;
    }

    public function update()
    {
        $conn = Database::getInstance();
        $sql = "UPDATE appointments
                SET
                rowIndex=:rowIndex, columnIndex=:columnIndex, userEmail=:userEmail, roomNum=:roomNum
                WHERE id=" . $this->id;

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":rowIndex", $this->rowIndex);
        $stmt->bindParam(":columnIndex", $this->columnIndex);
        $stmt->bindParam(":userEmail", $this->userEmail);
        $stmt->bindParam(":roomNum", $this->roomNum);

        $feedback = $stmt->execute();

        $conn = null;
    }

    public function delete()
    {
        $conn = Database::getInstance();
        $sql = "DELETE FROM appointments WHERE id=" .$this->id;
        $conn->query($sql);
        $conn = null;
    }

    public static function readAll($roomNum)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM appointments WHERE roomNum=$roomNum";
        $results = $conn->query($sql)->fetchAll();
        $returnArr = array();

        foreach ($results as $result) {
            $returnArr[$result['rowIndex']][$result['columnIndex']] = array('id' => $result['id'], 'userEmail' => $result['userEmail']);
        }

        return $returnArr;
    }

    public function getID(){
        return $this->id;
    }

    public function getRowIndex(){
        return $this->rowIndex;
    }

    public function setRowIndex($rowIndex){
        $this->rowIndex = $rowIndex;
    }

    public function getColumnIndex(){
        return $this->columnIndex;
    }

    public function setColumnIndex($columnIndex){
        $this->columnIndex = $columnIndex;
    }

    public function getUserEmail(){
        return $this->userEmail;
    }

    public function setUserEmail($userEmail){
        $this->userEmail = $userEmail;
    }

    public function getRoomNum(){
        return $this->roomNum;
    }

    public function setRoomNum($roomNum){
        $this->roomNum = $roomNum;
    }
}
