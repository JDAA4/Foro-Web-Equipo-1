<?php
namespace models;
use PDO;
class users extends connection{
    private $id;
    private $nickname;
    private $firstname;
    private $lastname;
    private $email;

    public function GetUsuariosIndex(){
        $sql="SELECT COUNT(*)FROM users";
        $execute = $this->conn->query($sql);
        $request = $execute->fetchColumn();
        return $request;
    }
} 
?>