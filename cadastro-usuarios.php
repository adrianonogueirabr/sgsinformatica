<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<form name="usuario" action="processa-usuarios.php?acao=cadastrar" method="post" >

<table width="100%" class="table responsive">
    <tr>
        <td> <?php include "inicial.php"?></td>
    </tr>
    <tr>
        <td><legend class="p-4 table-primary">Cadastro de Usuario</legend></td>
    </tr>
    <tr>
        <td>
            <div class="form-row">
                <div class="form-group  col-md-6 col-sm-6"><label for="nome">Nome</label>
                    <input class="form-control" name="nome" type="text" id="nome" required="required"   title="INFORME O NOME DO USUARIO" /></p>
                </div>

                <div class="form-group  col-md-6 col-sm-6"><label for="telefone">Telefone</label>
                    <input class="form-control" name="telefone" type="text" id="telefone" required="required"   title="INFORME O TELEFONE DO USUARIO" /></p>
                </div>

                <div class="form-group  col-md-6 col-sm-6"><label for="email">Email</label>
                    <input class="form-control " name="email" type="email" id="email" required="required"   title="INFORME O EMAIL DO USUARIO" /></p>
                </div>

                <input type="hidden" name="ativo"id="ativo" value="SIM" />

                <div class="form-group  col-md-3 col-sm-6"><label for="login">Login</label>
                    <input class="form-control " name="login" type="text" id="login" required="required"   title="INFORME O LOGIN DO USUARIO" /></p>
                </div>

                <div class="form-group  col-md-3 col-sm-6"><label for="senha">Senha</label>
                    <input class="form-control " name="senha" type="text" id="senha" required="required"   title="INFORME A SENHA DO USUARIO" /></p>
                </div>

                <div class="form-group  col-md-6 col-sm-6"><label for="cpfcnpj">Perfil</label>
                        <select name="perfil" class="form-control">
                        <?php
                        include "conexao.php"; 
                        $res1=$con->prepare("SELECT NUM_ID_PER, TXT_NOME_PER FROM TBL_PERFIL_PER WHERE TXT_ATIVO_PER = 'SIM'");
                        $res1->execute();

                        while($row1 = $res1->fetch(PDO::FETCH_OBJ)){?>
                        <option value="<?php echo $row1->NUM_ID_PER ?>">
                          <?php echo $row1->TXT_NOME_PER?>
                          </option>
                        <?php } ?>
                        </select>
                </div>

                <div class="form-group  col-md-6 col-sm-6"><label for="cpfcnpj">Loja</label>
                        <select name="empresa" class="form-control">
                        <?php
                        include "conexao.php"; 
                        $res1=$con->prepare("SELECT NUM_ID_EMP, TXT_FANTASIA_EMP FROM TBL_EMPRESA_EMP WHERE TXT_ATIVO_EMP = 'SIM'");
                        $res1->execute();

                        while($row1 = $res1->fetch(PDO::FETCH_OBJ)){?>
                        <option value="<?php echo $row1->NUM_ID_EMP ?>">
                          <?php echo $row1->TXT_FANTASIA_EMP?>
                          </option>
                        <?php } ?>
                        </select>
                </div>

                <div class="form-group col-md-2 col-sm-12">
                      <input type="submit" class="btn btn-outline-primary"  name="registrar"  value="Registrar Dados" />
                </div>
            </div>
        </td>
    </tr>
</table>
</form>
</body>
</html>