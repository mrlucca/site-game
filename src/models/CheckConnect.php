<?php


class CheckConnect
{
    private $password;
    private $email;
    private $connect;
    private $err = [];

    public function __construct($email, $password, $connect)
    {
        $this->password = $password;
        $this->email = $email;
        $this->connect = $connect;
    }

    private function check()
    {
        $email = mysqli_real_escape_string($this->connect, $this->email);
        $password = mysqli_real_escape_string($this->connect, $this->password);
        $query = "SELECT `email`, `password` FROM `users` WHERE email = '{$email}' and password = '{$password}'";
        $result = mysqli_query($this->connect, $query);
        $row = mysqli_num_rows($result);
        if($row !== 0){
            return true;
        }
        return false;

    }

    public function getName()
    {
        $result = $this->check();
        if($result) {
            $queryName = "SELECT `name` FROM `users` WHERE `email` = '{$this->email}'";
            $resultName = mysqli_query($this->connect, $queryName) or die('Name not found');
            $name = mysqli_fetch_assoc($resultName);
            return [
                "login" => true,
                "name" =>$name['name']
            ];
        }else {
            $errors = $this->checkUser();
            return [
                "login" => false,
                "err" => $errors,
            ];
        }
    }

    private function checkUser()
    {
       $query =  "SELECT `email` FROM `users` WHERE `email` = '{$this->email}'";
       $result = mysqli_query($this->connect, $query) or die('Name not found');
       $row = mysqli_num_rows($result);
        if($row === 0){
            array_push($this->err, 'Err: email not found!');
       }
        array_push($this->err,'Err: password not found!' );
        return $this->err;
    }

}

