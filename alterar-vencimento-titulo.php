<?php 

include "conexao.php";

$id = base64_decode($_GET['id']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<form name="titulo" action="processa-titulo-receber.php" method="post">
<table width="100%" class="table responsive">
    <tr>
        <td> <?php include "inicial.php"?></td>
    </tr>
    <tr>
		<td><legend class="p-4 table-primary">Alterar Vencimento Titulo</legend></td>
	</tr>
    <tr>
        <td>     
            <div class="form-row">
                <div class="form-group col-md-4 col-sm-12">  
                <input name="novadata" class="form-control" type="date" required="true" id="novadata" />	</p>
                <input name="codigo" id="codigo" type="hidden" value="<?php echo $id ?>" />
                </div>

                <div class="form-group col-md-2 col-sm-12">
                     <input type="submit" name="Alterar Dados"  value="Salvar Dados" class="btn btn-outline-danger"  />
                </div>
            </div>
        </td>
    </tr>
</TABLE>
</form>
</body>
</html>