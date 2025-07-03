<?php
use Model\Connection;

use PDO;
use PDOException;
class Imcs{
    private $db;

    public function __construct(){
    $this->db=Connection::getInstance();

    }
    public function createImc($weight,$height,$result):PDO
    {
    try{

    $sql= "INSERT INTO imcs(weight, height, result, created_at) VALUES(:weight, :height, :result, NOW())";

    $stmt= $this->db->prepare($sql);

    $stmt->bindParam(":weight",$weight, PDO::PARAM_STR);
    $stmt->bindParam(":height",$height, PDO::PARAM_STR);
    $stmt->bindParam(":result",$result, PDO::PARAM_STR);

    $execute = $stmt->execute();
// Verficicação de inserção de dados
    if ($execute){
        return true;
    }else{
        echo"Erro na criação de do IMC";
        return false;
    }
    }catch(PDOException $error){
    return "Erro na criação de ".$error->getMessage();
    }
    }
}
?>