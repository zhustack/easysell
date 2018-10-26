<?php

session_start();

class ProdutoController extends Controller {
	public function index() {
		echo "<label>Você está em produtos<label>";
	}

	public function create() {
        extract($_POST);

        if(Produto::whereRaw('prdtCodigo = ? and prdtStatus = "A"', [$codeProd])->get()->count() <= 0) {
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
            $_SESSION['prdtSucess'] = 1;
            header('Location: /mvcaplicado/public/gerente/cadastrarprodutos');
        } else {
            $_SESSION['prdtSucess'] = 0;
            header('Location: /mvcaplicado/public/gerente/cadastrarprodutos');
        }
       
	}
    
    public function show($idP) {
        if(isset($_SESSION['dadosGerente'])) {
            $produtoDetails = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "a" and Categoria.idFuncionario = ? and (idProduto = ? or prdtCodigo = ?)', [$_SESSION['dadosGerente']['idFuncionario'], $idP, $idP])->get()->toArray();
            echo json_encode($produtoDetails);
        } else {
            echo 0;
        }
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
