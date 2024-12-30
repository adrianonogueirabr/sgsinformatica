<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/formularios.css" rel="stylesheet" />
<title>LISTA DE CLIENTES - SGTECHFY</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="900" border="1" align="center" cellpadding="2" cellspacing="1">
    <tr>
      <th height="44" colspan="3" bgcolor="#0000FF" scope="col"><div id="tituloFormulario">Lista de Clientes</div></th>
    </tr>
    <tr>
      <th width="249" height="37" scope="row">
      <div id="nomeCriterio">
       <label><input type="radio" name="pesquisa" value="id" id="pesquisa_0" title="CONSULTAR PELO ID" />ID</label>
       <label><input type="radio" name="pesquisa" value="nome" id="pesquisa_1" title="CONSULTAR PELO NOME"/>NOME</label>
       <label><input type="radio" name="pesquisa" value="cpfcnpj" id="pesquisa_2" title="CONSULTAR PELO CPF OU CNPJ"/>CPF OU CNPJ</label>
       </div>
      </th>
      <td width="377">

      <input name="criterio" type="text" id="criterio" size="40" title="SELECIONE O CRITÉRIO DE BUSCA E DIGITE AQUI" / ></td>

      <td width="246" align="center" valign="middle"><p>
       
        <input type="submit" name="consultar" id="consultar" value="Consultar" title="CLIQUE PARA BUSCAR DADOS" />
        <input type="submit" name="novo" id="novo" value="Novo Cliente" title="CLIQUE PARA INSERIR UM NOVO CLIENTE" />
        <br />
      </p></td>
    </tr>
    <tr>
      <th height="23" colspan="3" scope="row">&nbsp;</th>
    </tr>
    <tr>
      <th height="299" colspan="3" align="center" valign="top" scope="row">
      <br>
      <table width="880" border="1" align="center" cellpadding="1" cellspacing="1" title="LISTA DE TODOS OS CLIENTES CADASTRADOS">
        <tr>
          <th width="41" height="20" bgcolor="#0000FF" scope="col"><div id="nomeCampo">ID</div></th>
          <th width="113" bgcolor="#0000FF" scope="col"><div id="nomeCampo">CPF/CNPJ</div></th>
          <th width="237" bgcolor="#0000FF" scope="col"><div id="nomeCampo">NOME</div></th>
          <th width="104" bgcolor="#0000FF" scope="col"><div id="nomeCampo">TELEFONE</div></th>
          <th width="238" bgcolor="#0000FF" scope="col"><div id="nomeCampo">EMAIL</div></th>
          <th width="94" bgcolor="#0000FF" scope="col"><div id="nomeCampo">AÇÃO</div></th>
        </tr>
        <tr>        
          <td height="20"><div id="valorCampo">0001</div></td>
          <td><div id="valorCampo">79615708291</div></td>
          <td><div id="valorCampo">ADRIANO NOGUEIRA DO NASCIMENTO</div></td>
          <td><div id="valorCampo">92991494069</div></td>
          <td><div id="valorCampo">adriano.nogueira@mardisa.com.br</div></td>
          <td align="center"><div id="valorCampo"><a href="#" title="CLIQUE PARA ALTERAR OS DADOS DESSE CLIENTE"> Alterar</a> | <a href="#" title="CLIQUE PARA MAIS DETALHES DESSE CLIENTE">Detalhes</a></div></td>

      </table> 
    </th>
    </tr>
    <tr>
      <th colspan="2" height="22"><div id="dadosRodape">SISTEMA DE GESTÃO TECHFY - SGTECHFY</div></th>
      <td><div id="dadosRodape">VERSÃO 1.1</div></td>
    </tr>
  </table>
</form>
</body>
</html>