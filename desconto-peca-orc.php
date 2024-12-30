
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
include "conexao.php";

    $id_os = $_GET["id"]; 
    $item_peca = $_GET["id_item_peca"];
        
?>

<form name="os" action="processa-orcamento.php?acao=descontopeca" method="post">
<INPUT TYPE="hidden" NAME="id_os" VALUE="<?php echo $id_os ?>" />
<INPUT TYPE="hidden" NAME="id_item_peca" VALUE="<?php echo $item_peca ?>" />
<table width="100%" class="table">
    <tr>
	      <td> <?php include "inicial.php"?> </td>
	  </tr>
    <tr>
        <td><h4 class="p-4 table-primary">Desconto Peca<h4></td>
    </tr>
</table>
<table width="100%" align="center" class="table">
  	<tr>
        <td>
            <?php
                include "conexao.php";
                $sqlItem = $con->prepare("SELECT * FROM TBL_ITEM_PECA_ORC WHERE NUM_ID_PECA_ORC = '$item_peca'");
                $sqlItem->execute();
                while ($rowItem = $sqlItem->fetch(PDO::FETCH_OBJ)){
            ?>        
                <?php
                    $id = $rowItem->TBL_PECA_PEC_NUM_ID_PEC;
                    $sqlItemNome = $con->prepare("SELECT TXT_NOME_PEC FROM TBL_PECA_PEC WHERE NUM_ID_PEC = '$id'");
                    $sqlItemNome->execute();
                    $nomePeca = $sqlItemNome->fetchColumn()
                ?>
            
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-6"><label>Servico</label>
                    <input title="NOME DO PECA" name="peca" id="peca" value="<?php echo $nomePeca ?>"  class="form-control" readonly /> </div>
                    
                    <div class="form-group col-md-2 col-sm-6"><label>Valor</label>
                    <input title="VALOR DA PECA" name="valor" id="valor" value="<?php echo $rowItem->VAL_VALOR_PECA_ORC ?>"  class="form-control" readonly /> </div> 

                    <div class="form-group col-md-2 col-sm-6"><label>Desconto</label>
                    <input title="DESCONTO DA PECA" name="desconto" id="desconto" value="<?php echo $rowItem->VAL_DESCONTO_PECA_ORC ?>" class="form-control" onblur="calculaDesconto()" /> </div>
                    
                    <div class="form-group col-md-2 col-sm-6"><label>Total</label>
                    <input title="VALOR FINAL DA PECA" name="total" id="total" value="<?php echo $rowItem->VAL_FINAL_PECA_ORC ?>" class="form-control" readonly /> </div> 
                    
                </div>

            <?php }  ?> 
        </td>
    </tr>
    <tr>
        <td>
        <div class="form-row">
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-outline-success btn-block" >Aplicar Desconto</button></div>
                    <div class="form-group col-md-2">
                        <a href="cadastro-orcamento.php?orcamento=<?php echo $id_os?>" class="btn btn-outline-warning btn-block" >Cancelar</a></div>
                    </div>
                </td>
                </tr>
</table>
    <script type="text/javascript" src="javascript/descontos.js"></script> 
</form>
</body>
</html>