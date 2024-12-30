//listar dados de tipo de frota

if(tipo){
    listarTipo();
}

async function listarTipo(){
    const dadosTipo = await fetch('listar_tipo_frota.php');
    const respostaTipo = await dadosTipo.json();  

    if(respostaTipo['status']){
        document.getElementById("msgAlertaTipo").innerHTML = "";
        document.getElementById("tipo").innerHTML = "";

        for (var i = 0; i< respostaTipo.dados.length; i++){
            //preenche formulario de cadastro de paciente
            //cadCategoriaPaciente.innerHTML = cadCategoriaPaciente.innerHTML +  '<option value="' + respostaCategoria.dados[i]['num_id_cat'] + '"> ' + respostaCategoria.dados[i]['txt_nome_cat'] + ' </option>'
            document.getElementById("tipo").innerHTML = document.getElementById("tipo").innerHTML +  '<option value="' + respostaTipo.dados[i]['num_id_tip'] + '"> ' + respostaTipo.dados[i]['txt_nome_tip'] + ' </option>'             
        }
    }else{
        document.getElementById("msgAlertaTipo").innerHTML = respostaTipo['msg'];
    }
}
//fim listar dados de tipo de frota

//listar dados de modelo de frota

if(tipo){
    listarModelo();
}

async function listarModelo(){
    const dadosModelo = await fetch('listar_modelo_frota.php');
    const respostaModelo = await dadosModelo.json();  

    if(respostaModelo['status']){
        document.getElementById("msgAlertaModelo").innerHTML = "";
        document.getElementById("modelo").innerHTML = "";

        for (var i = 0; i< respostaModelo.dados.length; i++){
            document.getElementById("modelo").innerHTML = document.getElementById("modelo").innerHTML +  '<option value="' + respostaModelo.dados[i]['num_id_mod'] + '"> ' + respostaModelo.dados[i]['txt_nome_mod'] + ' </option>'             
        }
    }else{
        document.getElementById("msgAlertaModelo").innerHTML = respostaTipo['msg'];
    }
}
//fim listar dados de modelo de frota

//listar dados de cor de frota

if(tipo){
    listarCor();
}

async function listarCor(){
    const dadosCor = await fetch('listar_cor_frota.php');
    const respostaCor = await dadosCor.json();  

    if(respostaCor['status']){
        document.getElementById("msgAlertaCor").innerHTML = "";
        document.getElementById("cor").innerHTML = "";

        for (var i = 0; i< respostaCor.dados.length; i++){
            document.getElementById("cor").innerHTML = document.getElementById("cor").innerHTML +  '<option value="' + respostaCor.dados[i]['num_id_cor'] + '"> ' + respostaCor.dados[i]['txt_nome_cor'] + ' </option>'             
        }
    }else{
        document.getElementById("msgAlertaCor").innerHTML = respostaCor['msg'];
    }
}
//fim listar dados de cor de frota

//listar dados de marca de frota

if(tipo){
    listarMarca();
}

async function listarMarca(){
    const dadosMarca = await fetch('listar_marca_frota.php');
    const respostaMarca = await dadosMarca.json();  

    if(respostaMarca['status']){
        document.getElementById("msgAlertaMarca").innerHTML = "";
        document.getElementById("marca").innerHTML = "";

        for (var i = 0; i< respostaMarca.dados.length; i++){
            document.getElementById("marca").innerHTML = document.getElementById("marca").innerHTML +  '<option value="' + respostaMarca.dados[i]['num_id_mar'] + '"> ' + respostaMarca.dados[i]['txt_nome_mar'] + ' </option>'             
        }
    }else{
        document.getElementById("msgAlertaMarca").innerHTML = respostaMarca['msg'];
    }
}
//fim listar dados de marca de frota

//funcao para remover o alerta da tela
function removeMensagem(){
    setTimeout(function(){
        document.getElementById("msgAlertaTipo").innerHTML = "";//
        document.getElementById("msgAlertaModelo").innerHTML = "";//
        document.getElementById("msgAlertaMarca").innerHTML = "";//
        document.getElementById("msgAlertaCor").innerHTML = "";//
    },5000);
}

//textos em maiusculo
document.getElementById('chassi').addEventListener('keyup', (ev) => {
	const input = ev.target;
	input.value = input.value.toUpperCase();
});

document.getElementById('placa').addEventListener('keyup', (ev) => {
	const input = ev.target;
	input.value = input.value.toUpperCase();
});

//fim textos em maiusculo