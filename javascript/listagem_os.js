	function verificaStatusOs(){
		d = document.listagem;
		
		if (d.pessoa.statusos == "PG" || d.pessoa.statusos == "FA") {
			alert("Nao pode alterar Ordem de Servico com status PG OU FA!");
			return false;
		}		
		
		return true;
		
	}


