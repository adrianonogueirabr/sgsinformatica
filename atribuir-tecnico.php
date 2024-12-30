
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
include "conexao.php";

    $item_servico = $_GET["id_item_servico"];
    $id_os = $_GET["id"];
        
?>

<form name="os" action="processa-os.php?acao=atribuirmecanico" method="post">
<INPUT TYPE="hidden" NAME="id_os" VALUE="<?php echo $id_os ?>" />
<INPUT TYPE="hidden" NAME="item_servico" VALUE="<?php echo $item_servico ?>" />
<table width="100%" class="table">
    <tr>
	    <td> <?php include "inicial.php"?> </td>
	</tr>
    <tr>
        <td><h4 class="p-4 table-primary">Atribuir Tecnico<h4></td>
    </tr>
</table>
<table width="100%" align="center" class="table">
  	<tr>
        <td>
            <?php
                include "conexao.php";
                $sqlItem = $con->prepare("SELECT * FROM TBL_ITEM_SERVICO_OS WHERE NUM_ID_SERVICO_OS = '$item_servico'");
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
                    <div class="form-group col-md-7 col-sm-6"><label>Servico</label>
                    <input title="NOME DO SERVICO" name="servico" id="servico" value="<?php echo $nomeServico ?>"  class="form-control" readonly /> </div>

                    <div class="form-group col-md-5 col-sm-10"><label>Tecnico</label>
                        <select name="tecnico" id="tecnico" class="form-control" title="SELECIONE O TECNICO DO SERVICO"> 
                                <?php
                                    include "conexao.php"; 
                                    $sqlMecanicos=$con->prepare("SELECT NUM_ID_TEC, TXT_NOME_TEC FROM TBL_TECNICO_TEC WHERE TXT_ATIVO_TEC = 'SIM' ORDER BY TXT_NOME_TEC");
                                    $sqlMecanicos->execute();
                                    while($sqlResultFim = $sqlMecanicos->fetch(PDO::FETCH_OBJ)){?>
                                        <option value="<?php echo $sqlResultFim->NUM_ID_TEC ?>"> <?php echo $sqlResultFim->TXT_NOME_TEC ?></option>
                                <?php } ?>
                        </select> 
                    </div> 
                </div>

            <?php }  ?> 
        </td>
    </tr>
    <tr>
        <td>
        <div class="form-row">
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-outline-success btn-block" >Salvar</button></div>
                    <div class="form-group col-md-2">
                        <a href="listagem-apontamento.php?id=<?php echo $id_os?>" class="btn btn-outline-warning btn-block" >Cancelar</a></div>
                    </div>
                </td>
                </tr>
</table>
    <script type="text/javascript" src="javascript/descontos.js"></script> 
</form>
</body>
</html>