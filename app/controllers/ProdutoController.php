<?php

class ProdutoController extends Controller {
	public function index() {
		echo "<label>Você está em produtos<label>";
	}

	public function create() {
        extract($_POST);
        Produto::CREATE([
            'prdtCodigo' => $codeProd,
            'prdtNome' => $prodName,
            'prdtValor' => $valorUni,
            'prdtQuantidade' => $quantidade,
            'prdtStatus' => 'A',
            'prdtDescricao' => $descricao,
            'idCategoria' => $prodCat,
            'idMarca' => $prodMarc
        ]);
		header('Location: /mvcaplicado/public/gerente/cadastrarprodutos');
	}
    
    public function show($idF, $idP) {
        $produtoDetails = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('Categoria.idFuncionario = ? and idProduto = ?', [$idF, $idP])->get()->toArray();
        
        echo $produtoDetails;
    }
}
