<?php 

  include "conexao.php";

  $id = base64_decode($_GET['id']);

  $sqlServico = $con->prepare("SELECT * FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$id'");
  if(!$sqlServico->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}

    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <body>
    <form name="servico" action="processa-servicos.php?acao=salvar" method="post" onSubmit="return validaForm()">
    <table width="100%" class="table responsive">
        <tr>
            <td> <?php include "inicial.php"?></td>
        </tr>
        <tr>
		    <td><legend class="p-4 table-primary">Detalhes</legend></td>
	    </tr>
<tr>
<td>  
    <?php
        while ($row = $sqlServico->fetch(PDO::FETCH_OBJ)){			
      ?> 
    <div class="form-row">  
        <input name="codigo" type="hidden" value="<?php echo $row->NUM_ID_SER ?>" />

        <div class="form-group  col-md-5 col-sm-6"><label for="nome">Nome</label>
            <input name="nome" type="text"  title="INFORME O NOME DO SERVICO" value="<?php echo $row->TXT_NOME_SER; ?>" class="form-control"  /></p>
        </div>

        <div class="form-group  col-md-5 col-sm-6"><label for="descricao">Descricao</label>
            <input name="descricao" type="text"  title="INFORME A DESCRICAO DO SERVICO" value="<?php echo $row->TXT_DESCRICAO_SER; ?>" class="form-control"  /></p>
        </div>

        <div class="form-group  col-md-2 col-sm-6"><label for="duracao">Tempo</label>
            <input name="duracao" type="number"  title="INFORME A DURACAO DO SERVICO EM HORAS" value="<?php echo $row->NUM_DURACAO_SER; ?>" class="form-control"  /></p>
        </div>

        <div class="form-group  col-md-3 col-sm-6"><label for="fisica">Valor Pessoa Fisica</label>
            <input name="fisica" type="double"  title="INFORME O VALOR PESSOA FISICA" value="<?php echo $row->VAL_FISICA_SER; ?>" class="form-control"  /></p>
        </div>

        <div class="form-group  col-md-3 col-sm-6"><label for="juridica">Valor Pessoa Juridica</label>
            <input name="juridica" type="double" title="INFORME O VALOR PESSOA JURIDICA" value="<?php echo $row->VAL_JURIDICA_SER; ?>" class="form-control"  /></p>
        </div>

        <div class="form-group  col-md-3 col-sm-6"><label for="contrato">Valor Contrato</label>
            <input name="contrato" type="double"  title="INFORME O VALOR PARA CONTRATOS" value="<?php echo $row->VAL_CONTRATO_SER; ?>" class="form-control"  /></p>
        </div>

        <div class="form-group  col-md-3 col-sm-6"><label for="contrato">Ativo</label>
                <select name="ativo" id="ativo" title="INFORME SE SERVICO ESTA ATIVO OU NAO" class="form-control">
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