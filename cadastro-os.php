<?php 
//verificacao se equipamento possui OS em garantia
  include "conexao.php";
  
 $id_e = base64_decode($_GET['id_e']);//id_e
 $id_cliente = base64_decode($_GET['id_c']);//id_c
 $nome_cliente = base64_decode($_GET['nc']);

 $iniciogarantia = date('Y-m-d');

    $sql = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP = '$id_e' and DTA_FIMGARANTIA_OS >= '$iniciogarantia'");
    $sql->execute();
    if($sql->rowCount()>0){ ?> 
          <div class="alert alert-danger" role="alert">
              Equipamento tem Ordem de Serviço em garantia, favor verificar!
          </div>
    <?php }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>

<form name="ordemservico" action="processa-os.php?acao=cadastrar" method="post" onSubmit="return validaForm()">
<INPUT TYPE="hidden" NAME="id_e" VALUE="<?php echo "$id_e" ?>" />
<INPUT TYPE="hidden" NAME="id_cliente" VALUE="<?php echo "$id_cliente" ?>" />

<table class="table responsive">
<tr>
    <td> <?php include "inicial.php"?></td>
</tr>
<tr>
	<td><legend class="p-4 table-primary">Nova Ordem de Servico<legend></td>
</tr>
<tr>
    <td>
        <div class="form-row g-3">
            <div class="form-group form-group-lg col-md-2 col-sm-6"><label for="tipo_atendimento">Tipo Atendimento</label>
                <select name="tipo_atendimento" id="tipo_atendimento" class="form-control" required title="INFORME O TIPO DE ATENDIMENTO AO CLIENTE">
                <option value="S">Selecione..</option>
                <option value="EMPRESA">EMPRESA</option>
                <option value="CLIENTE">CLIENTE</option>
                <option value="REMOTO">REMOTO</option>
                </select>
            </div> 

            <div class="form-group form-group-lg col-md-2 col-sm-6"><label for="tipo_os">Tipo</label>
                <select name="tipo_os" id="tipo_os" class="form-control" required title="INFORME O TIPO DA ORDEM DE SERVICO">
                <option value="S">Selecione..</option>
                <option value="PADRAO">PADRAO</option>
                <option value="GARANTIA">GARANTIA</option>
                </select>
            </div>  
            
            <div class="form-group  col-md-2 col-sm-6"><label for="km">KM Gasto</label>
                <input class="form-control input-lg" name="km" type="number" id="km" required="required" title="INFORME QUANTOS KM GASTO PRA IR AO LOCAL" />
            </div> 

            <div class="form-group  col-md-6 col-sm-6"><label for="nomeclient">Cliente</label>
                <input class="form-control input-lg" type="text"  value="<?php echo $nome_cliente ?>" readonly="true" title="NOME DO CLIENTE" /> 
            </DIV>

            <div class="form-group  col-md-9 col-sm-6"><label for="dadosgerais">Dados Gerais Equipamento</label>
                <input class="form-control input-lg" name="dadosgerais" type="text" id="dadosgerais" title="DESCREVA DEFEITOS ESTETICOS NO EQUIPAMENTO" />
            </div> 

            <div class="form-group  col-md-3 col-sm-6"><label for="previsao">Previsao</label>
                <input class="form-control input-lg" name="previsao" type="date" id="previsao" title="SELECIONE PREVISAO DE TERMINO" />
            </div>
        
            <div class="form-group col-md-12 col-sm-12"><label for="reclamacao">Reclamacao</label>
                <textarea name="reclamacao" id="reclamacao" class="form-control" required="required" cols="120" rows="3" title="INFORME A RECLAMACAO DO CLIENTE"></textarea> 
            </div>  
          
            <div class="form-group col-md-2">
                <input type="submit" name="registrar"  value="Registrar Dados" class="btn btn-outline-primary" />
            </div>
        </div>      
    </td>
</tr>
</table>
</form>
    <script type="text/javascript" src="javascript/cadastro_os.js"></script>
</body>
</html>