
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
	include "conexao.php";	

	if($_POST['valor']==""){
      $valor = base64_decode($_GET['valor']);
      $criterio = 'C';
  }else{
      $valor = $_POST['valor'];
	    $criterio = $_POST['criterio'];
  }

	if($criterio == "C"){
		$res = $con->prepare("SELECT C.TXT_RAZAO_CLI, E.TBL_CLIENTE_CLI_NUM_ID_CLI, E.NUM_ID_EQUIP, E.TXT_ATIVO_EQUIP, E.TXT_TIPO_EQUIP, E.TXT_MARCA_EQUIP, E.TXT_MODELO_EQUIP, 
                          E.TXT_SERIAL_EQUIP, E.TXT_DESCRICAO_EQUIP, E.DTH_REGISTRO_EQUIP FROM TBL_EQUIPAMENTO_EQUIP E 
                          LEFT JOIN TBL_CLIENTE_CLI C ON C.NUM_ID_CLI = E.TBL_CLIENTE_CLI_NUM_ID_CLI 
                          WHERE TBL_CLIENTE_CLI_NUM_ID_CLI = ?");
		$res->bindParam(1,$valor);
    if($res->execute());
		if($res->rowCount()<=0){
			$criterio = "I";

		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-clientes.php?valor=$valor&criterio=$criterio'><script type=\"text/javascript\">alert(\"Cliente nao possui equipamento registrados\");</script>";		
	}
	}else if($criterio == "I"){
		$res= $con->prepare("SELECT C.TXT_RAZAO_CLI, E.TBL_CLIENTE_CLI_NUM_ID_CLI, E.NUM_ID_EQUIP, E.TXT_ATIVO_EQUIP, E.TXT_TIPO_EQUIP, E.TXT_MARCA_EQUIP, E.TXT_MODELO_EQUIP, 
                         E.TXT_SERIAL_EQUIP, E.TXT_DESCRICAO_EQUIP, E.DTH_REGISTRO_EQUIP FROM TBL_EQUIPAMENTO_EQUIP E 
                         LEFT JOIN TBL_CLIENTE_CLI C ON C.NUM_ID_CLI = E.TBL_CLIENTE_CLI_NUM_ID_CLI 
                         WHERE NUM_ID_EQUIP = ?");
		$res->bindParam(1,$valor);
		$res->execute();
    if($res->rowCount()<=0){
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-equipamentos.php'><script type=\"text/javascript\">alert(\"Equipamento nao encontrado\");</script>";  
	}
	}else if($criterio == "S"){
		$res = $con->prepare("SELECT C.TXT_RAZAO_CLI,E.TBL_CLIENTE_CLI_NUM_ID_CLI, E.NUM_ID_EQUIP, E.TXT_ATIVO_EQUIP, E.TXT_TIPO_EQUIP, E.TXT_MARCA_EQUIP, E.TXT_MODELO_EQUIP, 
                           E.TXT_SERIAL_EQUIP, E.TXT_DESCRICAO_EQUIP, E.DTH_REGISTRO_EQUIP FROM TBL_EQUIPAMENTO_EQUIP E 
                           LEFT JOIN TBL_CLIENTE_CLI C ON C.NUM_ID_CLI = E.TBL_CLIENTE_CLI_NUM_ID_CLI
                           WHERE TXT_SERIAL_EQUIP = ?");
		$res->bindParam(1,$valor);
    $res->execute();
    if($res->rowCount()<=0){
    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-equipamentos.php'><script type=\"text/javascript\">alert(\"Equipamento nao encontrado\");</script>";  
  }
	}else if($criterio = ""){	
	 echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-equipamentos.php'><script type=\"text/javascript\">alert(\"Tente Novamente!\");</script>";
	}	 		

?>
<form name="listagem" method="post">
<table width="100%" class="table responsive">
  <tr>
      <td><?php include "inicial.php" ?></td>
  </tr>
  <tr>
      <td>
          <legend class="p-4 table-primary"><h3>Listagem de Equipamento</h3></legend>	
      </td>
  </tr>
  <tr>
      <td>
            <table class="table-hover table table-bordered  responsive table-sm">
                <tr class="table-success" align="center">		
                    <th scope="col">ID</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Equipamento</th>
                    <th scope="col">Utilizacao</th>
                    <th scope="col">Data</th>
                    <th scope="col">Opcoes</th>
                </tr>
                <?php 
                     while ($row = $res->fetch(PDO::FETCH_OBJ)){	
                ?>
                <tr align="center">
                  <td><?php echo $row->NUM_ID_EQUIP?></td>
                  <td><?php echo $row->TXT_ATIVO_EQUIP?></td>
                  <td align="left"><?php echo $row->TXT_RAZAO_CLI?></td>
                  <td><?php echo $row->TXT_TIPO_EQUIP?></td>
                  <td align="left"><?php echo $row->TXT_MARCA_EQUIP ?> / <?php echo $row->TXT_MODELO_EQUIP?> / <?php echo $row->TXT_SERIAL_EQUIP?></td>
                  <td align="left"><?php echo $row->TXT_DESCRICAO_EQUIP ?></td>
                  <td><?php echo date("d/m/Y  H:i:s",strtotime($row->DTH_REGISTRO_EQUIP)) ?></td>
                  <td>
                      <div class="btn-group dropleft">
                          <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="detalhes-equipamentos.php?id=<?php echo base64_encode($row->NUM_ID_EQUIP)?>">Detalhes</a>
                            <a class="dropdown-item" href="cadastro-os.php?id_e=<?php echo base64_encode($row->NUM_ID_EQUIP) ?>&id_c=<?php echo base64_encode($row->TBL_CLIENTE_CLI_NUM_ID_CLI)?>&nc=<?php echo base64_encode($row->TXT_RAZAO_CLI)?>">Abrir OS</a>
                            <a class="dropdown-item" href="listagem-os.php?id_e=<?php echo base64_encode($row->NUM_ID_EQUIP) ?>">Histórico de OS</a> 
                          </div>
                      </div>
                  </td>
                </tr>
            <?php } ?>
            </table> 
            <?php if ($criterio =="C"){ ?>      
                <div class="form-row">
                    <div class="form-group col-md-2 col-sm-12">
                        <a href="listagem-clientes.php?valor=<?php echo base64_encode($valor) ?>&criterio=I" class="btn btn-outline-secondary btn-block" role="button" aria-pressed="true">Voltar</a>                        
                    </div>
                    <div class="form-group col-md-2 col-sm-12">
                        <a href="cadastro-equipamentos.php?id=<?php echo base64_encode($valor) ?>" class="btn btn-outline-primary btn-block" role="button" aria-pressed="true"  >Novo Equipamento</a> 
                    </div>  
                </div>	
            <?php }?>           
        </td>
    </tr>
  </table>
</form>
</body>
</html>