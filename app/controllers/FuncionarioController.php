<?php

class FuncionarioController extends Controller 
{
	public function index() {
			echo "TA ATIVADO RAFAELA";
	}

	public function aguardeAtivacao() {
		echo "ESPERA ATIVAR NÃO TA ATIVADO";
	}

	public function editar($dados) {
		$dadosA = json_decode($dados);
		$funcionario = Funcionario::find($dadosA->id);
		$funcionario->update([
			'fCodigo' => $dadosA->codigo,
			'fNome' => $dadosA->nome,
			'fEmail' => $dadosA->email,
			'fStatus' => $dadosA->status
		]);
		
	}

	public function delete($id) {
		$funcionario = Funcionario::find($id);
		$funcionario->delete();
	}
}