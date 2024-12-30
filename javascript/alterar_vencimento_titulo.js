	function validaForm(){
		d = document.titulo;
		
		if (d.dia.value == "S"){
			alert("O campo tipo deve ser selecionado!");
			d.dia.focus();
			return false;
		}
		
		if (d.mes.value == "S"){
			alert("O campo tipo deve ser selecionado!");
			d.mes.focus();
			return false;
		}
		
		if (d.ano.value == "S"){
			alert("O campo tipo deve ser selecionado!");
			d.ano.focus();
			return false;
		}
				
		return true;
		
	}



