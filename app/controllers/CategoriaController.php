<?php

session_start();

class CategoriaController extends Controller {
	
	public function criar($ctgrNome) {

		if(Categoria::whereRaw('ctgrNome = ? and idFuncionario = ? and ctgrStatus = "A"', [$ctgrNome, $_SESSION['dadosGerente']['idFuncionario']])->get()->count() <= 0){
			Categoria::CREATE([
				'ctgrNome' => $ctgrNome,
				'idFuncionario' => $_SESSION['dadosGerente']['idFuncionario'],
				'ctgrStatus' => 'A'
			]);
			echo 1;
		} else {
			echo 0;
		}
	
		// echo $ctgrArray;
	}

	public function editar($dados) {
		$dadosA = json_decode($dados);
		if(Categoria::whereRaw('idFuncionario = ? and idCategoria = ? and ctgrStatus = "A"', [$_SESSION['dadosGerente']['idFuncionario'], $dadosA->id])->get()->count() > 0) {
			if(Categoria::whereRaw('idFuncionario = ? and ctgrNome = ? and ctgrStatus = "A"', [$_SESSION['dadosGerente']['idFuncionario'], $dadosA->nome])->get()->count() <= 0) {
				$categoria = Categoria::find($dadosA->id);
				$categoria->update([
					'idCategoria' => $dadosA->id,
					'ctgrNome' => $dadosA->nome
				]);

				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
		
	}

	public function delete($id) {
		if(Categoria::whereRaw('idCategoria = ? and idFuncionario = ? and ctgrStatus="A"', [$id, $_SESSION['dadosGerente']['idFuncionario']])->get()->count() > 0){
			$categoria = Categoria::find($id);
			$categoria->update([
				'ctgrStatus' => 'I'
			]);
			echo 1;
		} else {
			echo 0;

		}
        
	}
    
    public function listAll() {
        $lista = Categoria::whereRaw('idFuncionario = ? and ctgrStatus = "A"', [$_SESSION['dadosGerente']['idFuncionario']])->get();
		echo json_encode($lista);
	}

}