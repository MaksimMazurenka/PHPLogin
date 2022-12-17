<?php
class User{
    public $email;
    public $password;
    public $name;
    public $login;
    function __construct($login, $password, $email="", $name="") {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->login = $login;
    }
}
?>