function validaForm() {
  d = document.equipamento;

  if (d.placa.value == "") {
    alert("O campo " + d.placa.name + " deve ser preenchido!");
    d.cliente.focus();
    return false;
  }

  return true;
}
