<?php

class CategoriaController extends Controller {
	
	public function criar($ctgrJSON) {
		$ctgrArray= json_decode($ctgrJSON);
		Categoria::CREATE([
			'ctgrNome' => $ctgrArray->ctgrNome,
			'idFuncionario' => $ctgrArray->idFuncionario,
            'ctgrStatus' => 'A'
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
		$categoria->update([
            'ctgrStatus' => 'I'
        ]);
        
        echo $id;
	}
    
    public function listAll($id) {
        $lista = Categoria::whereRaw('idFuncionario = ? and ctgrStatus = "A"', [$id])->get();
		echo json_encode($lista);
	}

}