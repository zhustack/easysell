<?php

session_start();

class ProdutoController extends Controller {
	public function index() {
		echo "<label>Você está em produtos<label>";
	}

	public function create() {
        extract($_POST);

        if(Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->whereRaw('prdtCodigo = ? and prdtStatus = "A" and idFuncionario = ?', [$codeProd, $_SESSION['dados']['idFuncionario']])->get()->count() <= 0) {
            Produto::CREATE([
                'prdtCodigo' => $codeProd,
                'prdtNome' => $prodName,
                'prdtValor' => str_replace(',','.', $valorUni),
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
        if(isset($_SESSION['dados'])) {
            if(!isset($_SESSION['idGerente'])) {
                $produtoDetails = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "A" and Categoria.idFuncionario = ? and (idProduto = ? or prdtCodigo = ?)', [$_SESSION['dados']['idFuncionario'], $idP, $idP])->get()->toArray();
                echo json_encode($produtoDetails);
            } else {
                 $produtoDetails = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "A" and (idProduto = ? or prdtCodigo = ?)', [$idP, $idP])->get()->toArray();
                echo json_encode($produtoDetails);
                // echo "ue";
            }
        } else {
            echo 0;
        }
    }

    public function search($codigo) {
        if(Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->whereRaw('prdtStatus = "A" and Categoria.idFuncionario = ? and prdtCodigo = ?', [$_SESSION['dados']['idFuncionario'], $codigo])->get()->count() > 0){
            echo 0;
        } else {
            echo 1;
        }
    }
    
    public function editar($dados = '') {
        if($dados == '') {
            extract($_POST);

                $produto = Produto::find($idProduto);
                $produto->update([
                    'prdtCodigo' => $codeProd,
                    'prdtNome' => $prodName,
                    'prdtValor' => str_replace(',','.',$valorUni),
                    'prdtQuantidade' => $quantidade,
                    'prdtDescricao' => $descricao,
                    'idCategoria' => $prodCat,
                    'idMarca' => $prodMarc 
                ]);
                $_SESSION['prdtSucess'] = 1;

            header('location: /mvcaplicado/public/gerente/produto/detalhes/'.$idProduto.'');
        } else {
            $dadosArray = json_decode($dados);
        
                $produto = Produto::find($dadosArray->id);
                $produto->update([
                    'prdtCodigo' => $dadosArray->codigo,
                    'prdtNome' => $dadosArray->nome,
                    'prdtValor' => str_replace(',', '.', $dadosArray->valor),
                    'prdtQuantidade' => $dadosArray->quantidade,
                    'idCategoria' => $dadosArray->categoria,
                    'idMarca' => $dadosArray->marca
                ]);

                echo 1;

        }
        
        // header('location: /mvcaplicado/public/gerente/produto/detalhes/'.$idProduto.'/sucess');
    }
    
    public function delete($id) {
        if(Produto::join('categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->whereRaw('prdtStatus = "A" and idFuncionario = ? and idProduto = ?', [$_SESSION['dados']['idFuncionario'], $id])->get()->count() > 0){
            $produto = Produto::find($id);
            $produto->update([
                'prdtStatus' => 'I'
            ]);
            echo 1;
        } else {
            echo 0;
        }
    }
}
