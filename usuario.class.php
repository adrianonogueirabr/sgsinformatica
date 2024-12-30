<?php 

class usuario{    

    public function login($login,$senha){
        global $con;

        try{

        include "conexao.php";

        $sqlLogar = "SELECT * FROM tbl_usuario_usu WHERE TXT_LOGIN_USU = :login AND TXT_SENHA_USU = :senha AND TXT_ATIVO_USU = 'SIM'";
        
        $res = $con->prepare($sqlLogar);
		$res->bindValue("login",$login);
        $res->bindValue("senha",$senha);

                if(!$res->execute()){die ('Houve um erro na transacao: ' . mysqli_error($con));}        

            if($res->rowCount()>0)
            {
                while ($row = $res->fetch(PDO::FETCH_OBJ))
                {						

                    $_SESSION['id_usu'] = $row->NUM_ID_USU;	
                    $_SESSION['login_usu'] = $row->TXT_LOGIN_USU;	
                    $_SESSION['senha_usu'] = $row->TXT_SENHA_USU;			
                    $_SESSION['perfil_usu'] = $row->TBL_PERFIL_PER_NUM_ID_PER;
                    $_SESSION['empresa_usu'] = $row->TBL_EMPRESA_EMP_NUM_ID_EMP;
                }
                return true;

            }else{

                return false;         
            }
        
        }catch (Exception $e){
            echo 'Erro de execucao: ', $e->getMessage();
        }
    
    }

    public function logged($id){
        global $con;

        $sqlLogado = "SELECT * FROM tbl_usuario_usu WHERE TXT_LOGIN_USU = :login AND TXT_ATIVO_USU = 'SIM'";
        
        $res = $con->prepare($sqlLogado);
		$res->bindValue("login",$id);

        if(!$res->execute()){die ('Houve um erro na transacao: ' . mysqli_error($con));}

        if($res->rowCount()>0){
            return true;
        }

        return false;

    }



}


?>