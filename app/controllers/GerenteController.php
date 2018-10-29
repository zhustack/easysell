<?php

session_start();

class GerenteController extends Controller
{
	private $gerente;
	
	public function __construct(){
		if (session_status() == '2' && isset($_SESSION['dadosGerente'])) {
			$this->gerente = $_SESSION['dadosGerente'];
		} else {
			header('Location: /mvcaplicado/public/home/index');
		}
	}
	
	public function index() {	
		$this->view('gerente/index',['titlePage' => 'Painel Gerente', 'nomeGerente' => $this->gerente['fNome'], 'imgPerfil' => $this->gerente['fFoto']]);
	}

	public function funcionario($params = "") {
		$arrayVenIna = Vendedor::whereRaw('idTipoFunc = 2 and fELider = ?', [$this->gerente['fEmail']])->get()->toArray();
		$this->view('gerente/funcionarios', 
			[
				'titlePage' => "Edição de Funcionários",
				'nomeGerente' =>$this->gerente['fNome'],
				'imgPerfil' => $this->gerente['fFoto'],
				'funcionarios' => $arrayVenIna
			]);
	}

	public function categoriasemarcas() {
		$arrayCategegorias = Categoria::whereRaw('idFuncionario = ? and ctgrStatus = "A"', [$this->gerente['idFuncionario']])->get()->toArray();

		$arrayMarcas = Marca::whereRaw('idFuncionario = ? and mrcStatus = "A"', [$this->gerente['idFuncionario']])->get()->toArray();

		$this->view('gerente/categoriasemarcas',
			[
				'titlePage' => "Categorias e Marcas",
				'nomeGerente' => $this->gerente['fNome'],
				'imgPerfil' => $this->gerente['fFoto'], 
				'categorias' => $arrayCategegorias, 
				'marcas' => $arrayMarcas,
				'idFuncionario' => $this->gerente['idFuncionario']
			]
		);
	}

	public function cadastrarprodutos() {
        if(isset($_SESSION['prdtSucess'])) {
            $prdtSucess = $_SESSION['prdtSucess'];
            unset($_SESSION['prdtSucess']);
        } else {
            $prdtSucess = -1;
        }

		$this->view('gerente/cadastrarprodutos',
			[
				'titlePage' => "Cadastrar Produtos",
				'nomeGerente' => $this->gerente['fNome'],
                'imgPerfil' => $this->gerente['fFoto'], 
                'prdtSucess' => $prdtSucess,
                'idFuncionario' => $this->gerente['idFuncionario']
			]

		);
	}
    
    public function produto($details = '', $id = '') {

        if(isset($_SESSION['prdtError'])) {
            $prdtError = $_SESSION['prdtError'];
            unset($_SESSION['prdtError']);
        } else {
            $prdtError = -1;
        }

        if(isset($_SESSION['prdtSucess'])) {
            $prdtSucess = $_SESSION['prdtSucess'];
            unset($_SESSION['prdtSucess']);
        } else {
            $prdtSucess = -1;
        }

        if($details == 'detalhes' && !empty($id) && $id != '') {
            
            $produtoDetails = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "A" and Categoria.idFuncionario = ? and idProduto = ?', [$this->gerente['idFuncionario'], $id])->get()->toArray();
            
            if(isset($produtoDetails[0])){
               $this->view('gerente/detalhesprodutos',[
                    'titlePage' => "Detalhes Produtos",
                    'nomeGerente' => $this->gerente['fNome'],
                    'imgPerfil' => $this->gerente['fFoto'],
                    'msg' => $prdtSucess,
                    'produto' => $produtoDetails,
                    'idFuncionario' => $this->gerente['idFuncionario']
                ]); 
            } else {
                $_SESSION['prdtError'] = 1;
                header('location: /mvcaplicado/public/gerente/produto');
            }
        } else {
            if(isset($_GET['searchprod']) && $_GET['searchprod'] != '') {
                $arrayProdutos = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "a" and prdtCodigo = ? and Categoria.idFuncionario = ?', [$_GET['searchprod'],$this->gerente['idFuncionario']])->get()->toArray();
                $this->view('gerente/produtos',
                [
                    'titlePage' => "Gerenciar Produtos",
                    'nomeGerente' => $this->gerente['fNome'],
                    'imgPerfil' => $this->gerente['fFoto'], 
                    'produtos' => $arrayProdutos,
                    'msg' => $prdtError,
                    'idFuncionario' => $this->gerente['idFuncionario']
                ]
                        );    
            } else {
            
            $arrayProdutos = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "a" and Categoria.idFuncionario = ?', [$this->gerente['idFuncionario']])->get()->toArray();    
            $this->view('gerente/produtos',
                [
                    'titlePage' => "Gerenciar Produtos",
                    'nomeGerente' => $this->gerente['fNome'],
                    'imgPerfil' => $this->gerente['fFoto'], 
                    'produtos' => $arrayProdutos,
                    'msg' => $prdtError,
                    'idFuncionario' => $this->gerente['idFuncionario']
                ]
                        );
            }
        }
    }

    public function caixa(){

        $arrayProdutos = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "a" and Categoria.idFuncionario = ?', [$this->gerente['idFuncionario']])->get()->toArray();   
        
        $this->view('gerente/caixa',
                   [
                    'titlePage' => "Caixa",
                    'nomeGerente' => $this->gerente['fNome'],
                    'imgPerfil' => $this->gerente['fFoto'], 
                    'produtos' => $arrayProdutos,
                    'idFuncionario' => $this->gerente['idFuncionario']
                   ]
                   
                   );
    }
    
    public function showParams($params=""){
        echo $params;
    }
    
	public function destruir(){
		session_destroy();
        header('Location: index');
	}
}