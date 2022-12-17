<?php
class CRUD{
    private $filename = '../database/data.json';
    public function getAllUsers()
    {
        $data = file_get_contents($this->filename);
        $users = json_decode($data, true);
        $myArray = [];
        foreach($users as $key=>$value){
            foreach($value as $key1=>$value1){
                $email = "";
                $password = "";
                $name = "";
                $login="";
                foreach($value1 as $key2=>$value2){
                    if($key2=="email"){
                        $email = $value2;
                    }
                    if($key2=="login"){
                        $login = $value2;
                    }
                    if($key2 == "name"){
                        $name = $value2;
                    }
                    if($key2=="password"){
                        $password = $value2;
                    }
                }
                $user = new User($login,$password,$email,$name);
                array_push($myArray, (object)[$user]);
            }
        }
        return $myArray;
    }
    public function setUser($user)
    {
        if($this->getUserByLogin($user->login)==null){
            $users = $this->getAllUsers();
            array_push($users,(object)[$user]);
            $jsonString = json_encode($users, JSON_PRETTY_PRINT);
            $fp = fopen($this->filename, 'w');
            fwrite($fp, $jsonString);
            fclose($fp);
            return 1;
        }else{
            return 0;
        }
    }
    public function getUserByEmail($email)
    {
        $users = $this->getAllUsers();
        foreach($users as $key1=>$value1){
            foreach($value1 as $key2=>$value2){
                if($value2->email == $email){
                    return $value2;
                }
            }
        }
        return null;
    }
    public function getUserByLogin($login)
    {
        $users = $this->getAllUsers();
        foreach($users as $key1=>$value1){
            foreach($value1 as $key2=>$value2){
                if($value2->login == $login){
                    return $value2;
                }
            }
        }
        return null;
    }
    public function checkPassword($user1)
    {
        $user = $this->getUserByLogin($user1->login);
        if($user!=null){
            if($user1->password == $user->password){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}
?>