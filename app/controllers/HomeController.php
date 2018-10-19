<?php

class HomeController extends Controller
{

	public function index($param ='')
	{
        if($param == ''){
		  $this->view('home/index',['titlePage' => 'Entrar', 'error' => false]);  
        }else {
		  $this->view('home/index',['titlePage' => 'Entrar', 'error' => true]);  
        }

	}

	public function cadastrar()
	{
		$this->view('home/cadastrar',['titlePage' => 'Cadastrar']);

		if (isset($_POST['tipoConta'])) {

			$tipoConta = $_POST['tipoConta'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$nome = $_POST['name'];
			$sobrenome = $_POST['lastName'];
			$dataNasc = $_POST['birthday'];
			$nomeArquivo = $this->nomeArquivo();

			if ($tipoConta == 'gerente') {
				if ( Gerente::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A" and idTipoFunc = 1', [$email, $senha])->count() > 0 ) {
					header('location: index');
				} else {
					$this->salvarArquivo($nomeArquivo);
					Gerente::create([
						'fNome' => $nome,
						'fSobrenome' => $sobrenome,
						'fDataNasc' => $dataNasc,
						'fEmail' => $email,
						'fFoto' => $nomeArquivo,
						'fSenha' => $senha,
						'fStatus' => "A",
						'idTipoFunc' => 1
					]);
//					header('location: index');
				}
			} else {
				if ( Vendedor::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A" and idTipoFunc = 2', [$email, $senha])->count() > 0) {
					header('Location: index');
				} else {
					Vendedor::create([
						'fNome' => $nome,
						'fSobrenome' => $sobrenome,
						'fDataNasc' => $dataNasc,
						'fEmail' => $email,
						'fFoto' => $nomeArquivo,
						'fSenha' => $senha,
						'fStatus' => "R",
						'fELider' => $_POST['emailGerente'],
						'idTipoFunc' => 2
					]);
					header('location: /mvcaplicado/public/home/index');
				}
			}

		}
	}

	private function salvarArquivo( $nomeArquivo ) {
		$arquivo = $_FILES['photo']['tmp_name'];
		return move_uploaded_file ( $arquivo, "C:\wamp64\www\mvcaplicado\public\assets\imgsBanco\\$nomeArquivo");
	}

	private function nomeArquivo() {
		if ( isset($_FILES['photo']) && !empty($_FILES['photo']['name']) ) {
			$nome = $_FILES['photo']['name'];
			$arrayArquivo = explode('.', $nome);
			$extensao = $arrayArquivo[1];

			return microtime() . rand() . '.' . $extensao;
		} else {
			return "default.png";
		}
	}

	public function showParams($params = "", $a = "") {
		echo $params . $a;
	}

	public function listAll(){

	}

    public function login(){
        if (isset($_POST['btnLogin'])) {

            if (Gerente::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A" and idTipoFunc = 1', [$_POST['email'], $_POST['password']])->count() > 0) {
                session_start();
                $_SESSION['dadosGerente'] = Gerente::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A" and idTipoFunc = 1', [$_POST['email'], $_POST['password']])->firstOrFail()->toArray();
                header('Location: /mvcaplicado/public/gerente/index');
            } else if (Vendedor::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A" and idTipoFunc = 2', [$_POST['email'], $_POST['password']])->count() > 0) {
                header('Location: /mvcaplicado/public/funcionario/index');
            } else if (Vendedor::whereRaw('fEmail = ? and fSenha = ? and fStatus = "R" and idTipoFunc = 2', [$_POST['email'], $_POST['password']])->count() > 0) {
                header('Location: /mvcaplicado/public/funcionario/aguardeAtivacao');
            } else {
                header('Location: /mvcaplicado/public/home/index/error');
            }
        }
    } 
    
}
