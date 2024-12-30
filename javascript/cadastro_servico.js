
	function validaForm(){
		d = document.servico;
		
		if (d.nome.value == ""){
			alert("O campo " + d.nome.name + " deve ser preenchido!");
			d.nome.focus();
			return false;
		}
		
		if (d.descricao.value == ""){
			alert("O campo " + d.descricao.name + " deve ser preenchido!");
			d.descricao.focus();
			return false;
		}
		
		if(d.duracao.value == ""){
			alert("O campo " + d.duracao.name + " deve ser preenchido!");
			d.duracao.focus();
			return false;
		}

		if (isNaN(d.duracao.value)){
			alert("O campo " + d.duracao.name + " deve conter apenas numeros sem espacos!");
			d.duracao.focus();
			return false;
		}
		
		if (d.fisica.value == ""){
			alert("O campo " + d.fisica.name + " deve ser preenchido!");
			d.fisica.focus();
			return false;
		}
		
		if (d.juridica.value == ""){
			alert("O campo " + d.juridica.name + " deve ser preenchido!");
			d.juridica.focus();
			return false;
		}
		
		if (d.garantia.value == ""){
			alert("O campo " + d.garantia.name + " deve ser preenchido!");
			d.garantia.focus();
			return false;
		}
		
		if (d.interno.value == ""){
			alert("O campo " + d.interno.name + " deve ser preenchido!");
			d.interno.focus();
			return false;
		}
		
		if (d.contrato.value == ""){
			alert("O campo " + d.contrato.name + " deve ser preenchido!");
			d.contrato.focus();
			return false;
		}
		
		if (d.ativo.value == "SELECIONE"){
			alert("O campo ativo deve ser selecionado!");
			d.ativo.focus();
			return false;
		}
	
		return true;
		
	}


