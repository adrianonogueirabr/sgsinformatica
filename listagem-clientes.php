
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>

<?php 
  include_once "conexao.php";
  if($_POST['valor']==""){
      $valor = base64_decode($_GET['valor']);
      $criterio = 'I';
  }else{
	    $valor = $_POST['valor'];
	    $criterio = $_POST['criterio'];
  }
	
  $MensagemNaoEncontrado = "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-clientes.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";

	if($criterio == "C"){
		$res=$con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE TXT_CPF_CNPJ_CLI = ? ");
    $res->bindParam(1,$valor);
    if($res->execute());
		if($res->rowCount()<=0){
		echo $MensagemNaoEncontrado;		
	}
	}else if($criterio == "R"){
    $valor = '%'.$valor.'%';
		$res = $con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE TXT_RAZAO_CLI LIKE :valor limit 50");
    $res->bindParam('valor',$valor);
		if($res->execute());
    if($res->rowCount()<=0){
		echo $MensagemNaoEncontrado;		
	}	
	}else if($criterio == "I"){
		$res=$con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = ?");
		$res->bindParam(1,$valor);
    if($res->execute());
		if($res->rowCount()<=0){
		echo $MensagemNaoEncontrado;	
	}
	}else if($criterio = ""){
	   echo $MensagemNaoEncontrado;		
	}	
?>

<form name="listagem" method="post">

  <table width="100%" class="table responsive">
  <tr>
      <td><?php include "inicial.php" ?></td>
  </tr>
  <tr>
		  <td><legend class="p-4 table-primary">Listagem de Clientes<a href="cadastro-clientes.php"><legend></td>
	</tr>
  <tr>
      <td>
          <table class="table-hover table table-bordered  responsive table-sm">
              <tr class="table-success" align="center">		  
                  <th scope="col">ID</th>
                  <th scope="col">ATIVO</th>
                  <th scope="col">CPF/CNPJ</th>
                  <th scope="col">RAZAO</th>          
                  <th scope="col">TELEFONE</th>
                  <th scope="col">EMAIL</th>
                  <th scope="col">DATA</th>
                  <th scope="col">OPCOES</th>
              </tr>
              <?php
              while ($row = $res->fetch(PDO::FETCH_OBJ)){			
              ?>        
              <tr align="center">
                  <td><?php echo $row->NUM_ID_CLI;?></td>
                  <td><?php echo $row->TXT_ATIVO_CLI;?></td>
                  <td><?php echo $row->TXT_CPF_CNPJ_CLI;?></td>
                  <td align="left"><?php echo $row->TXT_RAZAO_CLI;?></td>          
                  <td><?php echo $row->TXT_TELEFONE_CLI;?></td>
                  <td align="left"><?php echo $row->TXT_EMAIL_CLI;?></td>
                  <?php //mensagem para exibicao de data de registro e alteracao do cliente 
                      $dataRegistro = date("d/m/Y  H:i:s",strtotime($row->DTH_REGISTRO_CLI));
                      $dataAlteracao = date("d/m/Y  H:i:s",strtotime($row->DTH_ALTERACAO_CLI));
                     $MensagemPopover = "Registro: $dataRegistro | Alteracao: $dataAlteracao";  
                  ?>            
                  <td><a href="#" data-toggle="popover" title="Cronologia do Cliente" data-content="<?php echo $MensagemPopover ?>">DATAS</a></td>
                  <td>
                      <div class="btn-group dropleft">
                          <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opcoes</button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="detalhes-clientes.php?id=<?php echo $row->NUM_ID_CLI;?>">Detalhes</a>                                  
                                  <?php  if($perfil_usuario == '00003'){ ?>        
                                      <a class="dropdown-item" href="cadastro-equipamentos.php?id=<?php echo base64_encode($row->NUM_ID_CLI)?>"> + Equipamento</a>
                                      <a class="dropdown-item" href="listagem-equipamentos.php?valor=<?php echo base64_encode($row->NUM_ID_CLI)?>">Listar Equipamentos</a>
                                  <?php }else if($perfil_usuario == '00002'){ ?>                                                                                                                 
                                      <a class="dropdown-item" href="dados-recebimento.php?criterio=AD&valor=<?php echo $row->NUM_ID_CLI;?>">+ Adiantamento</a>
                                      <a class="dropdown-item" href="listagem-recibo.php?criterio=I&valor=<?php echo $row->NUM_ID_CLI;?>">Recibos</a>
                                  <?php } ?>                                
                              </div>
                      </div>
                  </td>
              </tr>
              <?php
              }
              ?>
          </table>
      </td>
    </tr>
  </table>
</form>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>
</body>
</html>