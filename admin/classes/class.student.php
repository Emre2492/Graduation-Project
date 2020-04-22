<?php

/**
 *
 */
class Student extends User
{
    private $department;
    private $faculty;

    public function create()
    {
        $conn = Database::getInstance();
        $sql = "INSERT INTO students
                SET
                email=:email, password=:password, name=:name, surname=:surname, image=:image, department=:department, faculty=:faculty";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":faculty", $this->faculty);
        $stmt->bindParam(":department", $this->department);

        $stmt->execute();

        $feedback = $conn->lastInsertId();

        $conn = null;
        return $feedback;
    }

    public function update()
    {
        $conn = Database::getInstance();
        $sql = 'UPDATE students
                SET
                email=:email, password=:password, name=:name, surname=:surname, image=:image, department=:department, faculty=:faculty
                WHERE id=' . $this->id;

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":surname", $this->surname);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":faculty", $this->faculty);
        $stmt->bindParam(":department", $this->department);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function delete()
    {
        $conn = Database::getInstance();

        $sql = "DELETE FROM students WHERE id=:id";
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

        $sql = "SELECT * FROM students";

        $results = $conn->query($sql);

        try {
            while ($user = $results->fetch()) {
                $tempObj = new Student();

                $tempObj->id = (int)$user['id'];
                $tempObj->email = $user['email'];
                $tempObj->password = $user['password'];
                $tempObj->name = $user['name'];
                $tempObj->surname = $user['surname'];
                $tempObj->image = $user['image'];
                $tempObj->faculty = $user['faculty'];
                $tempObj->department = $user['department'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getStudentByID($id){
        $conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM students WHERE id=" . $id);
        $stmt->execute();

        $result = $stmt->fetch();

        $tempObj = new Student();

        $tempObj->id = (int)$result['id'];
        $tempObj->email = $result['email'];
        $tempObj->password = $result['password'];
        $tempObj->name = $result['name'];
        $tempObj->surname = $result['surname'];
        $tempObj->image = $result['image'];
        $tempObj->faculty = $result['faculty'];
        $tempObj->department = $result['department'];

        $conn = null;
        return $tempObj;
    }

    public static function getStudentByEmail($email){
        $conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM students WHERE email=" . $email);
        $stmt->execute();

        $result = $stmt->fetch();

        $tempObj = new Student();

        $tempObj->id = (int)$result['id'];
        $tempObj->email = $result['email'];
        $tempObj->password = $result['password'];
        $tempObj->name = $result['name'];
        $tempObj->surname = $result['surname'];
        $tempObj->image = $result['image'];
        $tempObj->faculty = $result['faculty'];
        $tempObj->department = $result['department'];

        $conn = null;
        return $tempObj;
    }

    public static function authUser($userID, $userPassword){
        $conn = Database::getInstance();

        $sql = "SELECT id, password FROM students WHERE id=:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $userID);
        $stmt->execute();

        $result = $stmt->fetch();

        $conn = null;
        return $result['password'] == $userPassword;
    }

    public static function getStudentInfoAsArray($id){
        $conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM students WHERE id=" . $id);
        $stmt->execute();

        $result = $stmt->fetch();

        $conn = null;
        return $result;
    }

    public function getFaculty()
    {
        return $this->faculty;
    }

    public function setFaculty($faculty)
    {
        $this->faculty = $faculty;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment($department)
    {
        $this->department = $department;
    }

}
