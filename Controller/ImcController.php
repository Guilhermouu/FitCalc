<?php
 
namespace Controller;
 
// ACESSANDO DIRETAMENTE O BANCO DE DADOS
use Model\Imcs;
 
use Exception;
 
Class ImcController {
    private $imcModel;
 
    public function __construct() {
        $this->imcModel = new Imcs();
    }
    /**
     * $result = [
     *      "imc" => 28.2,
     *      "BMIrange" => "Sobrepeso"
     * ]
     */
 
    public function calculateIMC($weight, $height) {
        try {
            $result = [];
 
            if(isset($weight) and isset($height)) {
                if($weight > 0 and $height > 0) {
                    $imc = round($weight / ($height * $height), 2);
                    $result["imc"] = $imc;
 
                    switch (true) {
                        case ($imc < 18.5):
                            $result["BMIrange"] = "Baixo peso";
                            break;
                        case ($imc >= 18.5 and $imc < 25):
                            $result["BMIrange"] = "Peso normal";
                            break;
                        case ($imc >= 25 and $imc < 30):
                            $result["BMIrange"] = "Sobrepeso";
                            break;
                        case ($imc >= 30 and $imc < 35):
                            $result["BMIrange"] = "Obesidade Grau I";
                            break;
                        case ($imc >= 35 and $imc < 40):
                            $result["BMIrange"] = "Obesidade Grau II";
                            break;
                        default:
                            $result["BMIrange"] = "Obesidade grau III";
                            break;
                    }
                } else {
                    $result["BMIrange"] = "Por favor, informe valores positivos!";
                }
            } else {
                $result["BMIrange"] = "Por favor, informe o seu peso e altura.";
            }
 
            return $result;
 
        } catch (Exception $e) {
            return throw new Exception("Erro ao calcular o seu IMC. Tente novamente!");
        }
    }
 
    public function saveIMC($weight, $height, $imcResult) {
        return $this->imcModel->createIMC($weight, $height, $imcResult);
    }
}
?>