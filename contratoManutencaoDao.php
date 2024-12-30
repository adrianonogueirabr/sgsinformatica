<?php 
require_once 'verifica.php';
include "conexao.php";
require_once 'contratoManutencao.php';

class ContratoManutencaoDao{

    public function RegistrarContrato(contratoManutencao $cm){
        try{
            include "conexao.php";
            require_once 'clienteDao.php';

            $cliente = new clienteDao();
            if($cliente->buscarCliente($cm->getCliente())=="OK"){

            $sql = $con->prepare("INSERT INTO TBL_CONTRATO_CM (TBL_USUARIO_USU_NUM_ID_USU, TBL_CLIENTE_CLI_NUM_ID_CLI, NUM_EQUIPAMENTOS_CM, DTA_INICIO_CM,DTA_TERMINO_CM,
             VAL_VALOR_CM, NUM_DIAPAGAMENTO_CM, TXT_ATIVO_CM) VALUES (?,?,0,now(),DATE_ADD(CURDATE(), INTERVAL 365 DAY),?,?,'S')");

            $sql->bindValue(1,$cm->getUsuario());
            $sql->bindValue(2,$cm->getCliente());
            $sql->bindValue(3,$cm->getValor());
            $sql->bindValue(4,$cm->getDiapagamento());

            $verificaexiste = $this->VerificaExiste($cm->getCliente());
            if($verificaexiste=="EXISTE"){
                print ("Cliente ja possui um cadastro de Contrato\n");
                return "ERRO";
            }else{
                if($sql->execute()){
                  return "OK";
                }else{
                  return "ERROR";
                }
            }
            }else{
                return "ERROR";
            }
        }catch(PDOexception $e){
            return 'error'.$e->getMessage();
        }
    }

    public function VerificaExiste($id){
        include "conexao.php";
        $sql = $con->prepare("SELECT * FROM TBL_CONTRATO_CM WHERE TBL_CLIENTE_CLI_NUM_ID_CLI = ? AND TXT_ATIVO_CM = 'S'");
        $sql->bindValue(1,$id);

        if($sql->execute()){
            if($sql->rowCount() > 0){                
                return "EXISTE";
            }
        }
    }

    public function ListarContratos(){
        include "conexao.php";
        $sql=$con->prepare("SELECT CM.NUM_ID_CM, CM.TXT_ATIVO_CM,CL.TXT_RAZAO_CLI,CL.NUM_ID_CLI, CM.DTA_INICIO_CM, CM.DTA_TERMINO_CM, CM.VAL_VALOR_CM, CM.NUM_DIAPAGAMENTO_CM, US.TXT_LOGIN_USU FROM TBL_CONTRATO_CM CM LEFT JOIN TBL_CLIENTE_CLI CL ON CL.NUM_ID_CLI = TBL_CLIENTE_CLI_NUM_ID_CLI LEFT JOIN TBL_USUARIO_USU US ON US.NUM_ID_USU = CM.TBL_USUARIO_USU_NUM_ID_USU  ");

        if($sql->execute());
		if($sql->rowCount()<=0){
		    echo "Nao existem contratos cadastrados!";		
        }else{
            return $resultado = $sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }

    public function AtualizarContrato(contratoManutencao $cm){
        try{
        include "conexao.php";

        $sql = $con->prepare("UPDATE TBL_CONTRATO_CM SET DTA_TERMINO_CM = ? , VAL_VALOR_CM = ? , NUM_DIAPAGAMENTO_CM = ? , TXT_ATIVO_CM = ? WHERE NUM_ID_CM = ?");
        $sql->bindValue(1,$cm->getDatatermino());
        $sql->bindValue(2,$cm->getValor());
        $sql->bindValue(3,$cm->getDiapagamento());
        $sql->bindValue(4,$cm->getAtivo());
        $sql->bindValue(5,$cm->getControle());

        if($sql->execute()){
            return "OK";
        }else{
            return "ERROR";
        }

        }catch(PDOexception $e){
            return 'error'.$e->getMessage(); 
        }
    }

    public function BloquearContrato(){

    }

    public function ReativarContrato(){

    }

    public function ContarMaquinas($id){       

        try{
            include "conexao.php";
            $sql = $con->prepare("SELECT * FROM TBL_EQUIPCONT_ECM WHERE TBL_CONTRATO_CM_NUM_ID_CM = ? ");
            $sql->bindValue(1,$id);
            
            if($sql->execute()){
                $qtd = $sql->rowCount();
                return $qtd;
            }else{
                return "ERROR";
            }
        
        }catch(PDOexception $e){
            return 'error'.$e->getMessage();
        }

    }

}


?>