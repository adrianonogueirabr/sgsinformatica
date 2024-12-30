
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
include "conexao.php";

    $id_os = $_GET["id"];     
        
?>

<form name="os" action="processa-orcamento.php?acao=condicaopagamento" method="post">
<INPUT TYPE="hidden" NAME="id_orc" VALUE="<?php echo $id_os ?>" />
<table width="100%" class="table">
    <tr>
	      <td> <?php include "inicial.php"?> </td>
	  </tr>
    <tr>
        <td><h4 class="p-4 table-primary">Condicao Pagamento<h4></td>
    </tr>
</table>
<table width="100%" align="center" class="table">
  	<tr>
        <td>
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-6"><label>Condicao de Pagamento</label>
                        <select name="condicaopagamento" id="condicaopagamento" class="form-control">
                            <option value="DINHEIRO/PIX/DEBITO">DINHEIRO/PIX/DEBITO</option>
                            <option value="DINHEIRO">DINHEIRO</option>                            
                            <option value="DEBITO">DEBITO</option>
                            <option value="CREDITO">CREDITO</option>
                            <option value="BOLETO">BOLETO</option>                                                                  
                        </select>
                    </div>                    
                </div>
        </td>
    </tr>
    <tr>
        <td>
        <div class="form-row">
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-outline-success btn-block" >Salvar</button></div>
                    <div class="form-group col-md-2">
                        <a href="cadastro-orcamento.php?orcamento=<?php echo $id_os?>" class="btn btn-outline-warning btn-block" >Cancelar</a></div>
                    </div>
                </td>
                </tr>
</table>    
</form>
</body>
</html>