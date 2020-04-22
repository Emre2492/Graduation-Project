<?php

/**
 *
 */
class Staff extends User
{
    private $room;
    private $type;

    public function create()
    {
        $conn = Database::getInstance();
        $sql = "INSERT INTO staffs
                SET
                email=:email, password=:password, name=:name, surname=:surname, image=:image, room=:room, type=:type";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":room", $this->room);
        $stmt->bindParam(":type", $this->type);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function update()
    {
        $conn = Database::getInstance();
        $sql = 'UPDATE staffs
                SET
                email=:email, password=:password, name=:name, surname=:surname, image=:image, room=:room, type=:type
                WHERE id=' . $this->id;

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":room", $this->room);
        $stmt->bindParam(":type", $this->type);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function delete()
    {
        $conn = Database::getInstance();

        $sql = "DELETE FROM staffs WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $this->id);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;

    }

    public static function readAll()
    {
        $returnArr = array();
        $conn = Database::getInstance();

        $sql = "SELECT * FROM staffs";

        $results = $conn->query($sql);

        try {
            while ($user = $results->fetch()) {
                $tempObj = new Staff();

                $tempObj->id = (int)$user['id'];
                $tempObj->email = $user['email'];
                $tempObj->password = $user['password'];
                $tempObj->name = $user['name'];
                $tempObj->surname = $user['surname'];
                $tempObj->image = $user['image'];
                $tempObj->room = $user['room'];
                $tempObj->type = (int)$user['type'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getStaffByID($id){
        $conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM staffs WHERE id=" . $id);
        $stmt->execute();

        $user = $stmt->fetch();

        $tempObj = new Staff();

        $tempObj->id = (int)$user['id'];
        $tempObj->email = $user['email'];
        $tempObj->password = $user['password'];
        $tempObj->name = $user['name'];
        $tempObj->surname = $user['surname'];
        $tempObj->image = $user['image'];
        $tempObj->room = $user['room'];
        $tempObj->type = (int)$user['type'];

        $conn = null;
        return $tempObj;
    }

    public static function getStaffByEmail($email){
        $conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM staffs WHERE email=" . $email);
        $stmt->execute();

        $user = $stmt->fetch();

        $tempObj = new Staff();

        $tempObj->id = (int)$user['id'];
        $tempObj->email = $user['email'];
        $tempObj->password = $user['password'];
        $tempObj->name = $user['name'];
        $tempObj->surname = $user['surname'];
        $tempObj->image = $user['image'];
        $tempObj->room = $user['room'];
        $tempObj->type = (int)$user['type'];

        $conn = null;
        return $tempObj;
    }

    public static function authUser($email, $userPassword){
        $conn = Database::getInstance();

        $userPassword = $userPassword;
        $sql = "SELECT email, password FROM staffs WHERE email=:email";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch();

        $conn = null;
        return $result['password'] == $userPassword;
    }

    public function getRoom(){
        return $this->room;
    }

    public function setRoom($room){
        $this->room = $room;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
    }

    public static function getStaffInfoAsArray($id){
        $conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM staffs WHERE id=" . $id);
        $stmt->execute();

        $result = $stmt->fetch();

        $conn = null;
        return $result;
    }

    public static function getStaffInfoAsArrayByEmail($email){
        $conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM staffs WHERE email='" . $email . "'");
        $stmt->execute();

        $result = $stmt->fetch();

        $conn = null;
        return $result;
    }
}
