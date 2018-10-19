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
        $produtoDetails = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "a" and Categoria.idFuncionario = ? and (idProduto = ? or prdtCodigo = ?)', [$idF, $idP, $idP])->get()->toArray();
        
        echo json_encode($produtoDetails);
    }
    
    public function editar($dados = '') {
        if($dados == '') {
            extract($_POST);
            $produto = Produto::find($idProduto);
            $produto->update([
                'prdtCodigo' => $codeProd,
                'prdtNome' => $prodName,
                'prdtValor' => $valorUni,
                'prdtQuantidade' => $quantidade,
                'prdtDescricao' => $descricao,
                'idCategoria' => $prodCat,
                'idMarca' => $prodMarc 
            ]);
        } else {
            $dadosArray = json_decode($dados);
            $produto = Produto::find($dadosArray->id);
            $produto->update([
                'prdtCodigo' => $dadosArray->codigo,
                'prdtNome' => $dadosArray->nome,
                'prdtValor' => $dadosArray->valor,
                'prdtQuantidade' => $dadosArray->quantidade,
                'idCategoria' => $dadosArray->categoria,
                'idMarca' => $dadosArray->marca
            ]);
        }
        
        header('location: /mvcaplicado/public/gerente/produto/detalhes/'.$idProduto.'/sucess');
    }
    
    public function delete($id) {
        $produto = Produto::find($id);
        $produto->update([
            'prdtStatus' => 'I'
        ]);
    }
}
