	function validaForm(){
		
		d = document.ordemservico;
		
		if (d.tipo_os.value == "S"){
			alert("O campo " + d.tipo_os.name + " deve ser selecionado!");
			d.tipo_os.focus();
			return false;
		}
		
		if (d.tipo_atendimento.value == "S"){
			alert("O campo " + d.tipo_atendimento.name + " deve ser selecionado!");
			d.tipo_atendimento.focus();
			return false;
		}
		
		if (d.dadosgerais.value == ""){
			alert("O campo " + d.dadosgerais.name + " deve ser preenchido!");
			d.dadosgerais.focus();
			return false;
		}
		
		if (d.dia.value == "S"){
			alert("O campo " + d.dia.name + " deve ser preenchido!");
			d.dia.focus();
			return false;
		}
		
		if (d.mes.value == "S"){
			alert("O campo " + d.mes.name + " deve ser preenchido!");
			d.mes.focus();
			return false;
		}
		
		if (d.ano.value == "S"){
			alert("O campo " + d.ano.name + " deve ser preenchido!");
			d.ano.focus();
			return false;
		}
		
		if (d.reclamacao.value == ""){
			alert("O campo " + d.reclamacao.name + " deve ser preenchido!");
			d.reclamacao.focus();
			return false;
		}
				
		return true;
		
	}
	
	function validaCancelamento(){
		d = document.os;
		
		if (d.tipo_os.value == "SELECIONE"){
			alert("O campo tipo deve ser selecionado!");
			d.tipo_os.focus();
			return false;
		}
		
		if (d.dadosgerais.value == ""){
			alert("O campo " + d.dadosgerais.name + " deve ser preenchido!");
			d.dadosgerais.focus();
			return false;
		}
		
		if (d.reclamacao.value == ""){
			alert("O campo " + d.reclamacao.name + " deve ser preenchido!");
			d.reclamacao.focus();
			return false;
		}		
		
		if (d.dia.value == "S"){
			alert("O campo " + d.dia.name + " deve ser preenchido!");
			d.dia.focus();
			return false;
		}
		
		if (d.mes.value == "S"){
			alert("O campo " + d.mes.name + " deve ser preenchido!");
			d.mes.focus();
			return false;
		}
		
		if (d.ano.value == "S"){
			alert("O campo " + d.ano.name + " deve ser preenchido!");
			d.ano.focus();
			return false;
		}
		
		if (d.cancelamento.value == ""){
			alert("O campo " + d.cancelamento.name + " deve ser preenchido!");
			d.cancelamento.focus();
			return false;
		}
				
		return true;
		
	}



