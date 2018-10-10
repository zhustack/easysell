<?php

class CategoriaController extends Controller {
	
	public function criar($ctgrJSON) {
		$ctgrArray= json_decode($ctgrJSON);
		Categoria::CREATE([
			'ctgrNome' => $ctgrArray->ctgrNome,
			'idFuncionario' => $ctgrArray->idFuncionario
		]);

		// echo $ctgrArray;
	}

	public function editar($dados) {
		$dadosA = json_decode($dados);
		print_r($dados);
		$categoria = Categoria::find($dadosA->id);
		$categoria->update([
			'idCategoria' => $dadosA->id,
			'ctgrNome' => $dadosA->nome
		]);
		
	}

	public function delete($id) {
		$categoria = Categoria::find($id);
		$categoria->delete();
        
        echo $id;
	}
    
    public function listAll($id) {
        $lista = Categoria::whereRaw('idFuncionario = ?', [$id])->get();
		echo json_encode($lista);
	}

}