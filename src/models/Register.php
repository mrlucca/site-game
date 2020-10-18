<?php

class Register
{
    private $name;
    private $lastName;
    private $email;
    private $password;
    private $confirmation_password;
    private $err = [];
    private  $connect;

    public function __construct(
        $name, $lastName,
        $email, $password,
        $confirmation_password,
        $connect
    )
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->confirmation_password = $confirmation_password;
        $this->connect = $connect;
    }

    public function registered()
    {
        $email_response = $this->getEmailValid();
        $password_response = $this->getConfirmationPassword();
        if(
            $email_response and
            $password_response
        ){
            $resultRegistered = $this->registerUser();
            return [
                "registered" => $resultRegistered
            ];

        }else {
            return [
                "registered" => false,
                "err" => $this->err,
            ];
        }
    }

    public function getEmailValid()
    {
        $query =  "SELECT `email` FROM `users` WHERE `email` = '{$this->email}'";
        $result = mysqli_query($this->connect, $query) or die('E-mail not found');
        if($result->fetch_assoc() !== null){
            array_push($this->err, '<b>Err:</b> E-mail has already been registered!');
            return false;
        }
        return true;
    }



    public function getConfirmationPassword()
    {
        if($this->confirmation_password == $this->password){
            return true;
        }else {
            array_push($this->err, "<b>Err:</b> Password don't match!");
            return false;
        }
    }

    private function registerUser()
    {
        $sql = "
        INSERT INTO users (name, password, email, is_admin)
        VALUES ('{$this->name} {$this->lastName}', '{$this->password}', '{$this->email}', 0);
        ";

        $result = mysqli_query($this->connect, $sql);
        if($result){
            return true;
        }
        array_push($this->err, "User not registered");
        return false;
    }
}