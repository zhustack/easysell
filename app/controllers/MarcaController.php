<?php

class MarcaController extends Controller {
	
	public function criar($mrcJSON) {
		$mrcArray= json_decode($mrcJSON);
		Marca::CREATE([
			'mrcNome' => $mrcArray->mrcNome,
			'idFuncionario' => $mrcArray->idFuncionario
		]);

		// echo $ctgrArray;
	}

	public function editar($dados) {
		$dadosA = json_decode($dados);
		print_r($dados);
		$marca = Marca::find($dadosA->id);
		$marca->update([
			'idCategoria' => $dadosA->id,
			'mrcNome' => $dadosA->nome
		]);
		
	}

	public function delete($id) {
		$marca = Marca::find($id);
		$marca->delete();
	}

	public function listAll($id) {
		$lista = Marca::whereRaw('idFuncionario = ?', [$id])->get();
		echo json_encode($lista);
	}

}