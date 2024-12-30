<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<?php 
	include "conexao.php";

		$sqlTitulo = $con->prepare("SELECT * FROM `TBL_TITULORECEBER_TR` WHERE TXT_STATUS_TR = 'ABERTO' order by NUM_ID_TR desc");
    if(!$sqlTitulo->execute()){echo 'Houve um erro no processamento da transacao ' . mysqli_error();}

    if($sqlTitulo->rowCount()==0){
		    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-titulo-receber.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
    }
?>

<form name="listagem" method="post">

<table width="100%" >
  <tr>
    <td>  
        <?php include "inicial.php" ?>    
   
  </td>
  </tr>

       
    <?php
		while ($row = $sqlTitulo->fetch(PDO::FETCH_OBJ)){		
      $con->beginTransaction();	

		  if ($row->DTA_VENCIMENTO_TR < date("Y-m-d") AND ($row->TXT_STATUS_TR =="ABERTO")){
           
            //capturar numero de dias de atraso 

             $diferenca =  strtotime(date("Y-m-d")) - strtotime($row->DTA_VENCIMENTO_TR);
             $diasAtrasado = floor($diferenca / (60 * 60 * 24));

             //capturando os valores de juros e multa da empresa
             $id_empresa_juros_multa = $row->TBL_EMPRESA_EMP_NUM_ID_EMP;
             $sql_empresa_juros_multa = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = $id_empresa_juros_multa");
             if(!$sql_empresa_juros_multa->execute()){echo 'Houve um erro ao realizar a transacao: ' . mysqli_error();}
       
             while ($row_empresa_juros_multa = $sql_empresa_juros_multa->fetch(PDO::FETCH_OBJ)){
             
                 $val_Juros =  $row_empresa_juros_multa->VAL_JUROS_EMP;
                 $val_Multa = $row_empresa_juros_multa->VAL_MULTA_EMP;
                 $val_total_juros = $val_Juros*$diasAtrasado;
                 $val_Total_Juros_Multa = $val_total_juros + $val_Multa + $row->VAL_VALOR_TR;
                  
             } 

             //atualizando tabela titulo com os valores de juros e multa
		        	$sql = $con->prepare("UPDATE TBL_TITULORECEBER_TR SET VAL_JUROS_TR = '$val_total_juros', VAL_MULTA_TR = '$val_Multa',VAL_FINAL_TR = '$val_Total_Juros_Multa' WHERE NUM_ID_TR = '$row->NUM_ID_TR'"); 
        			if(! $sql->execute() ){
			          die('Houve um erro no processamento da transação: ' . mysqli_error());
			          $con->rollBack();
			        }              
              
            }//FIM PRIMEIRO IF

            $con->commit();
           
          }//FIM WHILE
          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=inicial.php'><script type=\"text/javascript\">alert(\"Atualizado valores de Juros e Multa em titulos a receber!\");</script>";
        ?>
    <tr>
    <td>  
     
   
  </td>
  </tr>        
        
</table>
</form>
</body>
</html>