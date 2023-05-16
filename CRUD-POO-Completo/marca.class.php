<?php

class marca {
	private $codigo;
	private $descricao;

    public function __construct($codigo,$descricao) {
		$this->setCodigo($codigo);
        $this->setDescricao($descricao);
	}

	public function setCodigo($codigo) {
		if ($codigo >= 0) {
			$this->codigo = $codigo;
		}
	}

	public function getCodigo() {
		return $this->codigo;
	}

	public function setDescricao($descricao) {
		if (strlen($descricao) > 0) {
			$this->descricao = $descricao;
		}
	}

	public function getDescricao() {
		return $this->descricao;
	}

	public function __toString() {
		return "[Marca] Código: ".$this->codigo." | ".
		"Descrição: ".$this->descricao;
	}

}

?>