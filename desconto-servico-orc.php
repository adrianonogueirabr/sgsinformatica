
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
include "conexao.php";

    $id_os = $_GET["id"]; 
    $item_servico = $_GET["id_item_servico"];
        
?>

<form name="os" action="processa-orcamento.php?acao=descontoservico" method="post">
<INPUT TYPE="hidden" NAME="id_os" VALUE="<?php echo $id_os ?>" />
<INPUT TYPE="hidden" NAME="item_servico" VALUE="<?php echo $item_servico ?>" />
<table width="100%" class="table">
    <tr>
	      <td> <?php include "inicial.php"?> </td>
	  </tr>
    <tr>
        <td><h4 class="p-4 table-primary">Desconto Servico<h4></td>
    </tr>
</table>
<table width="100%" align="center" class="table">
  	<tr>
        <td>
            <?php
                include "conexao.php";
                $sqlItem = $con->prepare("SELECT * FROM TBL_ITEM_SERVICO_ORC WHERE NUM_ID_SERVICO_ORC = '$item_servico'");
                $sqlItem->execute();
                while ($rowItem = $sqlItem->fetch(PDO::FETCH_OBJ)){
            ?>        
                <?php
                    $id = $rowItem->TBL_SERVICO_SER_NUM_ID_SER;
                    $sqlItemNome = $con->prepare("SELECT TXT_NOME_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$id'");
                    $sqlItemNome->execute();
                    $nomeServico = $sqlItemNome->fetchColumn()
                ?>
            
                <div class="form-row">
                    <div class="form-group col-md-6 col-sm-6"><label>Servico</label>
                    <input title="NOME DO SERVICO" name="servico" id="servico" value="<?php echo $nomeServico ?>"  class="form-control" readonly /> </div>
                    
                    <div class="form-group col-md-2 col-sm-6"><label>Valor</label>
                    <input title="VALOR DO SERVICO" name="valor" id="valor" value="<?php echo $rowItem->VAL_VALOR_SERVICO_ORC ?>"  class="form-control" readonly /> </div> 

                    <div class="form-group col-md-2 col-sm-6"><label>Desconto</label>
                    <input title="DESCONTO DO SERVICO" name="desconto" id="desconto" value="<?php echo $rowItem->VAL_DESCONTO_SERVICO_ORC ?>" class="form-control" onblur="calculaDesconto()" /> </div>
                    
                    <div class="form-group col-md-2 col-sm-6"><label>Total</label>
                    <input title="VALOR FINAL DO SERVICO" name="total" id="total" value="<?php echo $rowItem->VAL_FINAL_SERVICO_ORC ?>" class="form-control" readonly /> </div> 
                    
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