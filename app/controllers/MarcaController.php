<?php

session_start();

class MarcaController extends Controller {
	
	public function criar($mrcNome) {
		
		if(Marca::whereRaw('mrcNome = ? and idFuncionario = ? and mrcStatus = "A"', [$mrcNome, $_SESSION['dados']['idFuncionario']])->get()->count() <= 0){
			Marca::CREATE([
				'mrcNome' => $mrcNome,
				'idFuncionario' => $_SESSION['dados']['idFuncionario'],
				'mrcStatus' => 'A'
			]);
			echo 1;
		} else {
			echo 0;
		}

	}

	public function editar($dados) {
		$dadosA = json_decode($dados);
		if(Marca::whereRaw('idFuncionario = ? and idMarca = ? and mrcStatus = "A"', [$_SESSION['dados']['idFuncionario'], $dadosA->id])->get()->count() > 0) {
			if(Marca::whereRaw('idFuncionario = ? and mrcNome = ? and mrcStatus = "A"', [$_SESSION['dados']['idFuncionario'], $dadosA->nome])->get()->count() <= 0) {
				$marca = Marca::find($dadosA->id);
				$marca->update([
					'idCategoria' => $dadosA->id,
					'mrcNome' => $dadosA->nome
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
		if(Marca::whereRaw('idMarca = ? and idFuncionario = ? and mrcStatus = "A"', [$id, $_SESSION['dados']['idFuncionario']])->get()->count() > 0) {
			$marca = Marca::find($id);
			$marca->update([
				'mrcStatus' => 'I'
			]);
			echo 1;
		} else {
			echo 0;
		}
	}

	public function listAll() {
		$lista = Marca::whereRaw('idFuncionario = ? and mrcStatus = "A"', [$_SESSION['dados']['idFuncionario']])->get();
		echo json_encode($lista);
	}

}