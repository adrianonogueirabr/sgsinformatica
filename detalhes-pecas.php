<?php 

    include "conexao.php";

    $id = base64_decode($_GET['id']);

    $sqlServico = $con->prepare("SELECT * FROM TBL_PECA_PEC WHERE NUM_ID_PEC = '$id'");

    if(!$sqlServico->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}

    while ($row = $sqlServico->fetch(PDO::FETCH_OBJ)){

    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <body>
    <form name="pecas" action="processa-pecas.php?acao=salvar" method="post" onSubmit="return validaForm()">
    <table width="100%" class="table responsive">
        <tr>
            <td> <?php include "inicial.php"?></td>
        </tr>
        <tr>
		    <td><legend class="p-4 table-primary">Detalhes: <?php echo $row->TXT_NOME_PEC ?></legend></td>
	    </tr>
        <tr>
            <td>  
                <div class="form-row">  
                    <input name="id" type="hidden" value="<?php echo $row->NUM_ID_PEC ?>" />

                    <div class="form-group  col-md-5 col-sm-6"><label for="nome">Nome</label>
                        <input name="nome"  id="nome" type="text"  title="INFORME O NOME DA PECA" value="<?php echo $row->TXT_NOME_PEC ?>" class="form-control"  /></p>
                    </div>

                    <div class="form-group  col-md-5 col-sm-6"><label for="codigo">Codigo</label>
                        <input name="codigo" id="codigo" type="text"  title="INFORME O CODIGO DA PECA" value="<?php echo $row->TXT_CODIGO_PEC ?>" class="form-control"  /></p>
                    </div>

                    <div class="form-group  col-md-2 col-sm-6"><label for="venda">Valor Venda</label>
                        <input name="valor" id="valor" type="double"  title="INFORME VALOR DE VENDA DA PECA" value="<?php echo $row->VAL_VALOR_VENDA_PEC ?>" class="form-control"  /></p>
                    </div>

                    <div class="form-group  col-md-12 col-sm-6"><label for="ativo">Ativo</label>
                            <select name="ativo" id="ativo" title="INFORME SE PECA ESTA ATIVO OU NAO" class="form-control">
                            <option value="SIM">SIM</option>
                            <option value="NAO">NAO</option>
                        </select>  
                    </div>

                    <div class="form-group col-md-2 col-sm-12">
                        <input type="submit" name="Alterar Dados"  value="Salvar Dados" class="btn btn-outline-danger"  />
                    </div>
                </div>   
            </td>
        </tr>
<?php
  }//FIM DO RES
?>
</table>
</form>
</body>
</html>