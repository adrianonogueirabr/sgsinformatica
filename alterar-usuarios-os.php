<?php include "verifica.php"; 

include "conexao.php";

$id = $_GET['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />
<script type="text/javascript" src="javascript/cadastro_usuario.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alterar Filial do Usuario</title>
</head>

<body>
<form name="usuario" action="processa-os.php?acao=atribuirtecnico" method="post" onSubmit="return validaForm()">
  <table width="100%" class="table-condensed" align="left" >
    <tr>
	 <tr>
     <td><legend><h3><a href="consulta-usuarios.php"><img src="imagens/voltar.png" width="30" height="30" alt="voltar" /></a>Atribuir Tecnico a Ordem de Serviço</h3></legend></td>
  </tr>
  <tr>
    <td>    
    <table width="50%" class="table-condensed" align="LEFT">
  <tr>
    <td><label>TECNICO</label></td>  
   

   <input name="id_os" type="hidden" value="<?php echo $id ?>" />

    	<td><select name="tecnico" class="form-control" > 
        <?php
        include "conexao.php"; 
        $sql=$con->prepare("SELECT NUM_ID_USU, TXT_NOME_USU FROM TBL_USUARIO_USU WHERE TXT_ATIVO_USU = 'S' AND TBL_PERFIL_PER_NUM_ID_PER = 5 AND TBL_EMPRESA_EMP_NUM_ID_EMP = $empresa_usuario");
        if(!$sql->execute()){ die(mysql_error());}
          while($sqlResultFim =$sql->fetch(PDO::FETCH_OBJ)){?>
          <option value="<?php echo $sqlResultFim->NUM_ID_USU?>"> <?php echo $sqlResultFim->TXT_NOME_USU?></option>
          <?php } ?>
        </select>
      </td>
       <td height="30" align="center"><input type="submit" class="btn-success btn" name="registrar"  value="Salvar Dados" /></td>
  </tr>  
    </table>
    
    </td>
  </tr>
  <tr>
     
  </tr>

</table>

</form>
</body>
</html>