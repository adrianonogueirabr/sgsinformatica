<?php 

class ContratoManutencao{

    private $cliente;
    private $usuario;
    private $controle;
    private $qtdequipamentos;
    private $datainicio;
    private $datatermino;
    private $valor; 
    private $diapagamento; 
    private $ativo;

    public function getCliente(){
        return $this->cliente;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

	public function getControle(){
        return $this->controle;
    }

    public function setControle($controle){
        $this->controle = $controle;
    }

    public function getQtdequipamentos(){
        return $this->qtdequipamentos;
    }

    public function setQtdequipamentos($qtdequipamentos){
        $this->qtdequipamentos = $qtdequipamentos;
    }

    public function getDatainicio(){
        return $this->datainicio;
    }

    public function setDatainicio($datainicio){
        $this->datainicio = $datainicio;
    }

    public function getDatatermino(){
        return $this->datatermino;
    }

    public function setDatatermino($datatermino){
        $this->datatermino = $datatermino;
    }
    
    public function getValor(){
        return $this->valor;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getDiapagamento(){
        return $this->diapagamento;
    }

    public function setDiapagamento($diapagamento){
        $this->diapagamento = $diapagamento;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setAtivo($ativo){
        $this->ativo = $ativo;
    }

}

?>