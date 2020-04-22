<?php

/**
* 
*/
class Lecture
{
	private $lecCode;
	private $title;
	private $professor;
	private $department;
	private $persentages;

	public function create($lecCode)
    {
        $conn = Database::getInstance();
        $sql = "INSERT INTO lectures
                SET
                lecCode=:lecCode, title=:title, professor=:professor, department=:department, persentages=:persentages";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":lecCode", $lecCode);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":professor", $this->professor);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":persentages", $this->persentages);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function update()
    {
        $conn = Database::getInstance();
        $sql = 'UPDATE lectures
                SET
                title=:title, professor=:professor, department=:department, persentages=:persentages
                WHERE lecCode="' . $this->lecCode . '"';

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":professor", $this->professor);
        $stmt->bindParam(":department", $this->department);
        $stmt->bindParam(":persentages", $this->persentages);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public function delete()
    {
        $conn = Database::getInstance();

        $sql = "DELETE FROM lectures WHERE lecCode=:lecCode";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":lecCode", $this->lecCode);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;

    }

    public static function getLecturesByDepartmentID($departmentID)
    {
    	$conn = Database::getInstance();

    	$sql = "SELECT * FROM lectures WHERE department = {$departmentID}";
    	$results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($lecture= $results->fetch()) {
                $tempObj = new Lecture();

                $tempObj->lecCode = $lecture['lecCode'];
                $tempObj->title = $lecture['title'];
                $tempObj->professor = $lecture['professor'];
                $tempObj->department = $lecture['department'];
                $tempObj->persentages = $lecture['persentages'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getLectureByLecCode($lecCode){
    	$conn = Database::getInstance();
        $stmt = $conn->prepare("SELECT * FROM lectures WHERE lecCode='" . $lecCode . "'");
        $stmt->execute();

        $result = $stmt->fetch();

        $tempObj = new Lecture();

        $tempObj->lecCode = $result['lecCode'];
        $tempObj->title = $result['title'];
        $tempObj->professor = $result['professor'];
        $tempObj->department = $result['department'];
        $tempObj->persentages = $result['persentages'];

        $conn = null;
        return $tempObj;
    }

    public static function getGroupedLectureList()
    {
        $faculties = Faculty::readAll();
        $departments = Department::readAll();
        $lectures = self::readAll();

        $departmentArr = array();

        foreach ($departments as $department) {
            foreach ($lectures as $lecture) {
                if ($lecture->department == $department->getID())
                    $departmentArr[$department->getID()][] = $lecture;
            }
        }
        
        return $departmentArr;
    }

    public static function readAll()
    {
    	$conn = Database::getInstance();

    	$sql = "SELECT * FROM lectures";
    	$results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($lecture = $results->fetch()) {
                $tempObj = new Lecture();

                $tempObj->lecCode = $lecture['lecCode'];
                $tempObj->title = $lecture['title'];
                $tempObj->professor = $lecture['professor'];
                $tempObj->department = $lecture['department'];
                $tempObj->persentages = $lecture['persentages'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function requestLecture($user, $lecCode, $professor, $operation)
    {
        $conn = Database::getInstance();

        $sql = "INSERT INTO lec_enrollment
                SET
                lecCode=:lecCode, stuID=:stuID, operation=:operation";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":lecCode", $lecCode);
        $stmt->bindParam(":stuID", $user);
        $stmt->bindParam(":operation", $operation);

        $feedback = $stmt->execute();

        $conn = null;
        return $feedback;
    }

    public static function getClassList($lecCode)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM class_list WHERE lecCode='$lecCode'";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($student = $results->fetch()) {
                array_push($returnArr, $student['stuID']);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getEnrollmentQueue($lecCode)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM lec_enrollment WHERE lecCode='$lecCode' ORDER BY stuID";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($student = $results->fetch()) {
                $returnArr[$student['operation']][] = $student['stuID'];
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getEnrollmentQueueWithStuID($lecCode)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM lec_enrollment WHERE lecCode='$lecCode' ORDER BY stuID";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($student = $results->fetch()) {
                $returnArr[] = $student['stuID'];
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getStudentLectureList($stuID)
    {
        $conn = Database::getInstance();
        $sql = "SELECT lectures.lecCode, lectures.title, lectures.professor, lectures.department
                FROM class_list
                INNER JOIN lectures ON lectures.lecCode = class_list.lecCode
                WHERE class_list.stuID = $stuID";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($lecture = $results->fetch()) {
                $tempObj = new Lecture();

                $tempObj->lecCode = $lecture['lecCode'];
                $tempObj->title = $lecture['title'];
                $tempObj->professor = $lecture['professor'];
                $tempObj->department = $lecture['department'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getStudentEnrollmentQueue($stuID)
    {
        $conn = Database::getInstance();
        $sql = "SELECT lectures.lecCode, lectures.title, lectures.professor, lectures.department
                FROM lec_enrollment
                INNER JOIN lectures ON lectures.lecCode = lec_enrollment.lecCode
                WHERE lec_enrollment.stuID = $stuID";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($lecture = $results->fetch()) {
                $tempObj = new Lecture();

                $tempObj->lecCode = $lecture['lecCode'];
                $tempObj->title = $lecture['title'];
                $tempObj->professor = $lecture['professor'];
                $tempObj->department = $lecture['department'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function search($query)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM lectures WHERE title LIKE '%" . $query . "%'";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($lecture = $results->fetch()) {
                $tempObj = new Lecture();

                $tempObj->lecCode = $lecture['lecCode'];
                $tempObj->title = $lecture['title'];
                $tempObj->professor = $lecture['professor'];
                $tempObj->department = $lecture['department'];

                array_push($returnArr, $tempObj);
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getUserTimeSchedule($userID)
    {
        $conn = Database::getInstance();
        $sql = "SELECT ts.* 
                FROM timeschedule AS ts
                INNER JOIN class_list as cl
                    ON ts.lecture = cl.lecCode
                WHERE cl.stuID = $userID";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($lecture = $results->fetch()) {
                $returnArr[$lecture['rowIndex']][$lecture['columnIndex']][] = $lecture['lecture'];
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function getStaffTimeSchedule($userID)
    {
        $conn = Database::getInstance();
        $sql = "SELECT ts.* 
                FROM timeschedule AS ts
                INNER JOIN lectures as lec
                    ON ts.lecture = lec.lecCode
                WHERE lec.professor = $userID";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($lecture = $results->fetch()) {
                $returnArr[$lecture['rowIndex']][$lecture['columnIndex']][] = $lecture['lecture'];
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    public static function approveStudent($lecCode, $stuID)
    {
        $conn = Database::getInstance();
        $sql = "INSERT INTO class_list SET stuID = $stuID, lecCode = '$lecCode'; ";
        $sql .= "DELETE FROM lec_enrollment WHERE stuID = $stuID AND lecCode = '$lecCode' AND operation = 'enroll'";
        $conn->query($sql);
        $conn = null;
    }

    public static function declineStudent($lecCode, $stuID)
    {
        $conn = Database::getInstance();
        $sql = "DELETE FROM lec_enrollment WHERE stuID = $stuID AND lecCode = '$lecCode'";
        $conn->query($sql);
        $conn = null;
    }

    public static function removeStudent($lecCode, $stuID)
    {
        $conn = Database::getInstance();
        $sql = "DELETE FROM class_list WHERE stuID = $stuID AND lecCode = '$lecCode'; ";
        $sql .= "DELETE FROM lec_enrollment WHERE stuID=$stuID AND lecCode = '$lecCode';";
        $conn->query($sql);
        $conn = null;
    }

	public function getLecCode(){
		return $this->lecCode;
	}

    public static function getStaffLectures($staffID)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM lectures WHERE professor=$staffID";
        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($lecture = $results->fetch()) {
                $tempObj = new Lecture();

                $tempObj->lecCode = $lecture['lecCode'];
                $tempObj->title = $lecture['title'];
                $tempObj->professor = $lecture['professor'];
                $tempObj->department = $lecture['department'];

                array_push($returnArr, $tempObj);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $returnArr;
    }

    public static function adjustTimeTable($lecCode, $rowIndex, $columnIndex)
    {
        $conn = Database::getInstance();
        $sql = "INSERT INTO timeschedule SET rowIndex=$rowIndex, columnIndex=$columnIndex, lecture='$lecCode'";
        $conn->query($sql);
        $conn = null;
    }

    public static function clearPreviousTimeSchedule($lecCode)
    {
        $conn = Database::getInstance();
        $sql = "DELETE FROM timeschedule WHERE lecture='$lecCode'";
        $conn->query($sql);
        $conn = null;
    }

    public static function getLectureTimeSchedule($lecCode)
    {
        $conn = Database::getInstance();
        $sql = "SELECT * FROM timeschedule
                WHERE lecture = '$lecCode'";

        $results = $conn->query($sql);

        $returnArr = array();

        try {
            while ($lecture = $results->fetch()) {
                $returnArr[$lecture['rowIndex']][$lecture['columnIndex']][] = $lecture['lecture'];
            }

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $conn = null;
        return $returnArr;
    }

    /*
	public function setLecCode($lecCode){
        #TODO : handle with database too
		$this->lecCode = $lecCode;
	}*/

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getProfessor(){
		return $this->professor;
	}

	public function setProfessor($professor){
		$this->professor = $professor;
	}

	public function getDepartment(){
		return $this->department;
	}

	public function setDepartment($department){
		$this->department = $department;
	}

	public function getPersentages(){
		return $this->persentages;
	}

	public function setPersentages($persentages){
		$this->persentages = $persentages;
	}
}