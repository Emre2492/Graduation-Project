<?php

/**
* 
*/
class User
{
	protected $id;
    protected $email;
    protected $password;
    protected $name;
    protected $surname;
    protected $image;

    public static function getUserByID($id, $type){
        if($type == 1 || $type == 2 || $type == 4 || $type == 5){
        	return Staff::getStaffByID($id);
        }
        else if ($type == 3) {
        	return Student::getStudentByID($id);
        }
        else{
        	throw new Exception("Unmatched type", 1);
        }
    }

    public function getUserByEmail($email, $type)
    {
        if($type == 1 || $type == 2){
            return Staff::getStaffByEmail($id);
        }
        else if ($type == 3) {
            return Student::getStudentByEmail($id);
        }
        else{
            throw new Exception("Unmatched type", 1);
        }
    }

    public function getID(){
        return $this->id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        $this->image = $image;
    }

    private static function generatePassword()
    {
        #https://stackoverflow.com/questions/4356289/php-random-string-generator
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }

    public static function resetPassword($userEmail, $userType)
    {
        $tableName = '';
        $randPass = self::generatePassword();
        $conn = Database::getInstance();

        switch ($userType) {
            case 'student':
                $tableName = 'students';
                break;

            case 'staff':
                $tableName = 'staffs';
                break;
            
            default:
                throw new Exception("Kullanici tipi verilmedi!", 1);
                break;
        }

        $sql = "UPDATE {$tableName} SET password=:password WHERE email=:email";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":email", $userEmail);
        $stmt->bindParam(":password", md5($randPass));
        $stmt->execute();
        
        if ($stmt->rowCount() > 0){
            $mail = new MailWorker(true);

            try {
                $mail->addAddress($userEmail);
                $mail->Subject = "UZEM PLUS: Yeni parolaniz";
                $mail->Body = "
                            Sayin kullanici,<br>
                            UZEM PLUS hesabiniz icin yeni bir sifre olusturulmustur. Sifreniz asagida yer almaktadir.<br>

                            <pre>
                                {$randPass}
                            </pre>
                            <br>

                            Iyi gunler dileriz,<br>
                            UZEM PLUS
                          ";

            $mail->send();

            } catch (Exception $exception) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }

            unset($mail);
        } else {
            throw new Exception("Parola yenilenemedi!", 1);
            
        }

        $conn = null;
    }

    public static function checkIfRegistered($userEmail, $userType)
    {
        $tableName = '';
        $conn = Database::getInstance();

        switch ($userType) {
            case 'student':
                $tableName = 'students';
                break;

            case 'staff':
                $tableName = 'staffs';
                break;
            
            default:
                throw new Exception("Kullanici tipi verilmedi!", 1);
                break;
        }

        $sql = "SELECT COUNT(*) FROM {$tableName} WHERE email='{$userEmail}'";
        $count = $conn->query($sql)->fetchColumn();
        $feedback = ($count > 0) ? true : false;

        $conn = null;
        return $feedback;
    }   
}