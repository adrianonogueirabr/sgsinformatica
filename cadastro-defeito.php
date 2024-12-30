<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
include "conexao.php";
$id_os = base64_decode($_GET["idos"]); 

$res = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$id_os' AND TXT_STATUS_OS = 'ANDAMENTO'");	

if(! $res->execute() ){
    die('Houve um erro no processamento da transação: ' . mysqli_error());
}

if($res->rowCount()==0){
    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Ordem de Servico precisa estar em Andamento!\");</script>";    
}
?>

<form name="cadastro-defeito" action="processa-os.php?acao=cadastrar_defeito" method="post" onSubmit="return validaForm()">
<INPUT TYPE="hidden" NAME="id_os" VALUE="<?php echo $id_os ?>" />
<table  class="table">
    <tr>
	      <td> <?php include "inicial.php"?> </td>
	  </tr>
    <tr>
        <td><h4 class="p-4 table-primary">Alterar ou Cadastrar Defeito<h4></td>
    </tr>
  	<tr>
        <td>
            <?php 		
            while ($row = $res->fetch(PDO::FETCH_OBJ)){	 
            ?>            
                <div class="form-group col-md-12 col-sm-12">
                    <textarea class="form-control" name="defeito" id="defeito" rows="3" title="INFORME O DEFEITO DO EQUIPAMENTO"><?php echo $row->TXT_DEFEITO_OS ?></textarea>
                </div>

                <div class="form-row">
                      <div class="form-group col-md-2">
                          <input class=" btn btn-outline-success btn-block" type="submit"  value="Registrar Defeito" title="CLIQUE PARA REGISTRAR DEFEITO" /> 
                      </div>
                      <div class="form-group col-md-2">
                          <a href="listagem-apontamento.php?id=<?php echo $id_os?>" class="btn btn-outline-danger btn-block" title="CLIQUE PARA CANCELAR E VOLTAR AO APONTAMENTO">Cancelar</a>
                      </div>
                </div>
           
		    </td>
    </tr>
</table>

</form>
<?php } ?>
    <script type="text/javascript" src="javascript/cadastro-defeito.js"></script>
</body>
</html>