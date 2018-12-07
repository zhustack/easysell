<?php

session_start();

class FuncionarioController extends Controller 
{

	private $funcionario;
	private $idGerente;
	
	public function __construct(){
		if (session_status() == '2' && isset($_SESSION['dados'])) {
			$this->funcionario = Funcionario::find($_SESSION['dados']['idFuncionario'])->toArray();
			$this->idGerente = Gerente::whereRaw('fEmail = ?', [$this->funcionario['fELider']])->get()->toArray()[0]['idFuncionario'];
			$_SESSION['idGerente'] = $this->idGerente;
		} else {
			header('Location: /mvcaplicado/public/home/index');
		}
	}

	public function index() {
		/*$this->view('funcionario/index',['titlePage' => 'EasySell', 'fNome' => $this->funcionario['fNome'], 'imgPerfil' => $this->funcionario['fFoto']]); */
		header('Location: /mvcaplicado/public/venda/grafics');
	}

	function exibe() {
		echo $this->idGerente;
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
            
            $produtoDetails = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "A" and Categoria.idFuncionario = ? and idProduto = ?', [$this->idGerente, $id])->get()->toArray();
            
            if(isset($produtoDetails[0])){
               $this->view('funcionario/detalhesprodutos',[
                    'titlePage' => "Detalhes Produtos",
                    'fNome' => $this->funcionario['fNome'],
                    'imgPerfil' => $this->funcionario['fFoto'],
                    'msg' => $prdtSucess,
                    'produto' => $produtoDetails,
                    'idFuncionario' => $this->funcionario['idFuncionario']
                ]); 
            } else {
                $_SESSION['prdtError'] = 1;
                header('location: /mvcaplicado/public/funcionario/produto');
			}
		} else {
			if(isset($_GET['searchprod']) && $_GET['searchprod'] != '') {
			$arrayProdutos = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "a" and prdtCodigo = ? and Categoria.idFuncionario = ?', [$_GET['searchprod'],$this->idGerente])->get()->toArray();
			$this->view('funcionario/produtos',
			[
				'titlePage' => "Lista de Produtos",
				'fNome' => $this->funcionario['fNome'],
				'imgPerfil' => $this->funcionario['fFoto'], 
				'produtos' => $arrayProdutos,
				'msg' => $prdtError,
				'idFuncionario' => $this->funcionario['idFuncionario']
			]
				);    
		} else {
			$arrayProdutos = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "a" and Categoria.idFuncionario = ?', [$this->idGerente])->get()->toArray();    
			$this->view('funcionario/produtos',
				[
					'titlePage' => "Lista de Produtos",
					'fNome' => $this->funcionario['fNome'],
					'imgPerfil' => $this->funcionario['fFoto'], 
					'produtos' => $arrayProdutos,
					'msg' => $prdtError,
					'idFuncionario' => $this->funcionario['idFuncionario']
				]
			);
		}
	}	
	}

	public function aguardeAtivacao() {
		echo "ESPERA ATIVAR NÃO TA ATIVADO";
	}

	public function editar($dados) {
		$dadosA = json_decode($dados);
		$funcionarioE = Funcionario::find($dadosA->id);
		$funcionarioE->update([
			'fCodigo' => $dadosA->codigo,
			'fNome' => $dadosA->nome,
			'fEmail' => $dadosA->email,
			'fStatus' => $dadosA->status
		]);
		
	}

	public function configuracoes(){
        $msg = 0;
        if(isset($_POST['idFuncionario'])) {
            extract($_POST);
            
            if(Funcionario::whereRaw('fEmail = ? and fStatus="A"', [$fEmail])->count() == 0 || $this->funcionario['fEmail'] == $fEmail) {
                if($flagFoto == 0) {
                    $fFoto = $this->nomeArquivo();
                } else {
                    $fFoto="default.png";
                }
                Funcionario::find($idFuncionario)->update([
                    'fNome' => $fNome, 
                    'fSobrenome' => $fSobrenome,
                    'fDataNasc' => $fDataNasc,
                    'fFoto' => $fFoto,
                    'fEmail' => $fEmail,
                    'fSenha' => $fSenha != '' ? $fSenha: $this->funcionario['fSenha']
                ]);

                $msg = 0;
                $this->salvarArquivo($fFoto);
                $this->funcionario = funcionario::find($idFuncionario)->toArray();
                //    $this->gerente = $_SESSION['dados'];
                    // header('Location: /mvcaplicado/public/gerente/configuracoes')
            } else {
                $msg = 1;
            }
        }

        $this->view('funcionario/configuracoes',
        [
            'titlePage' => "Configurações",
            'fNome' => $this->funcionario['fNome'],
            'imgPerfil' => $this->funcionario['fFoto'], 
            'msg' => $msg,
            'dadosFuncionario' => $this->funcionario
    ]);
       
    }

	private function salvarArquivo( $nomeArquivo ) {
		$arquivo = $_FILES['fFoto']['tmp_name'];
		return move_uploaded_file ( $arquivo, "C:\wamp64\www\mvcaplicado\public\assets\imgsBanco\\$nomeArquivo");
	}

	private function nomeArquivo() {
		if ( isset($_FILES['fFoto']) && $_FILES['fFoto']['name'] != 'default.png' && $_FILES['fFoto']['name'] != "") {
			$nome = $_FILES['fFoto']['name'];
			$arrayArquivo = explode('.', $nome);
			$extensao = $arrayArquivo[1];

			return microtime() . rand() . '.' . $extensao;
		} else if($_FILES['fFoto']['name'] == "") {
            return $this->funcionario['fFoto'];
        } else {
			return "default.png";
		}
	}

	public function delete($id) {
		$this->$funcionario = Funcionario::find($id);
		$this->$funcionario->delete();
	}

	public function destruir(){
		session_destroy();
        header('Location: /mvcaplicado/public/home/index');
    }
}