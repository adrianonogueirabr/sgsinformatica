function aplicaDesconto(){

	let desconto = parseFloat(document.getElementById("desconto").value);
	let total = parseFloat(document.getElementById("total_os").value);

	if (desconto >= total) {
		alert("Valor do desconto nao pode ser maior ou igual a: R$" + total);
		document.getElementById("desconto").value = 0;
		document.getElementById("desconto").focus();
		document.getElementById("valor1").value = total;
	}else{
		valor = total - desconto;
		document.getElementById("valor1").value = valor;
	}
}

function aplicaDescontoCaixa(){	

	let desconto = parseFloat(document.getElementById("desconto").value);
	let valorFinal = parseFloat(document.getElementById("valorFinal").value);
	let valorTotal = parseFloat(document.getElementById("valorTotal").value);
		
		if (desconto >= valorFinal) {
			let erro = valorTotal + desconto;
			document.getElementById("desconto").value = 0;
			document.getElementById("desconto").focus();			
			document.getElementById("valorFinal").value = erro ;
			alert("Valor do desconto nao pode ser maior ou igual a: R$" + valorFinal);			
		}else{
			valor = valorFinal - desconto;
			document.getElementById("valorFinal").value = valor;
		}	

}

function validaForm(){
		d = document.faturamento;
		
		if (d.desconto.value == ""){
			alert("Informe o valor a ser pago");
			d.valor1.focus();
			return false;
		}
		
		if (d.condicaopagamento.value == 2 && d.datavencimento1.value == ""){
			
			alert("Caso condicao de pagamento Titulo 1x necessario selecionar data de vencimento");
			d.datavencimento1.focus();
			return false;
		}
		
		return true;
		
}
