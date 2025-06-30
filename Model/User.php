<?php
 
namespace Model;
 
use Exception;
use Model\Connection;
 
use PDO;
use PDOException;
 
class User
{
    private $db;
 
    public function __construct(){
        $this->db = Connection::getInstance();
    }
 
    //FUNÇÃO DE INSERÇÃO DE USUÁRIO
    public function post($user_fullname, $email, $password)
    {
       
        try{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
 
            $sql = "INSERT INTO user (user_fullname, email, password, created_at) VALUES (:user_fullname, :email, :password, NOW())";
 
            $stmt = $this->db->prepare($sql);
 
            $stmt->bindParam(":user_fullname", $user_fullname, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
 
 
            $execute = $stmt->execute();
 
            if($execute){
                return true;
            } else {
               return throw new Exception("Deu ruim ao inserir os dados do usuário");
            }
 
        } catch (PDOException $error) {
            echo("Erro de Execução " . $error->getMessage());
            return false;
        }
    }
        
}
 
?>