<?php 
class ContratoManutencaoDao{

    public function RegistarContrato(contratoManutencao $cm){
        try{
            $sql = 'INSERT INTO TBL_CONTRATO_CM (TBL_USUARIO_USU_NUM_ID_USU, TBL_CLIENTE_CLI_NUM_ID_CLI, NUM_EQUIPAMENTOS_CM, DTA_INICIO_CM, DTA_TERMINO_CM, VAL_VALOR_CM, NUM_DIAPAGAMENTO_CM, TXT_ATIVO_CM)
            VALUES (?,?,?,?,?,?,?,"SIM")';
            $stmt = getConn()->prepare($sql);
            $stmt->bindValue(1,$cm->getUsuario());
            $stmt->bindValue(2,$cm->getCliente());
            $stmt->bindValue(2,$cm->getControle());
            $stmt->bindValue(2,$cm->getDatainicio());
            $stmt->bindValue(2,$cm->getDatatermino());
            $stmt->bindValue(2,$cm->getValor());
            $stmt->bindValue(2,$cm->getDiapagamento());
            
            if($stmt->execute()){
                return "OK";
            }else{
                return "ERROR";
            }
        
        }catch(PDOexception $e){
            return 'error'.$e->getMessage();
        }

    }

    public function ConsultarContrato(){

    }

    public function ListarContratos(){

    }

    public function EditarContrato(){

    }

    public function BloquearContrato(){

    }

    public function ReativarContrato(){

    }

}


?>