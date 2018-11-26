<?php

class HomeController extends Controller
{

	public function index($param ='')
	{
        if($param == ''){
		  $this->view('home/index',['titlePage' => 'Entrar', 'message' => 0]);  
        }else if ($param == "sucess") {
		  $this->view('home/index',['titlePage' => 'Entrar', 'message' => 1]);  
		}else if($param == "loginInvalid") {
			$this->view('home/index',['titlePage' => 'Entrar', 'message' => 2]);
		}
		else {
			$this->view('home/index',['titlePage' => 'Entrar', 'message' => -1]);  
			
		}

	}

	public function teste($fEmail) {
        echo Funcionario::whereRaw('fEmail = ? and fStatus="A"', [$fEmail])->count();
    }

	public function cadastrar()
	{
		$this->view('home/cadastrar',['titlePage' => 'Cadastrar']);
	}

	public function processa_cadastro()
	{
		if (isset($_POST['tipoConta'])) {

			$tipoConta = $_POST['tipoConta'];
			$email = $_POST['email'];
			$senha = $_POST['senha'];
			$nome = $_POST['name'];
			$sobrenome = $_POST['lastName'];
			$dataNasc = $_POST['birthday'];
			$nomeArquivo = $this->nomeArquivo();

			if ($tipoConta == 'gerente') {
				if ( Funcionario::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A"', [$email, $senha])->count() > 0 ) {
					header('Location: /mvcaplicado/public/home/index/error');
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
					header('Location: /mvcaplicado/public/home/index/sucess');
					
				}
			} else {
				if ( Funcionario::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A"', [$email, $senha])->count() > 0) {
					header('Location: /mvcaplicado/public/home/index/error');
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
					header('Location: /mvcaplicado/public/home/index/sucess');
				}
			}

		}
	}

	public function buscaEmailG($email) {
        if(Gerente::whereRaw('fEmail = ? and fStatus = "A" and idTipoFunc = 1',[$email])->count() > 0) {
            echo 1;
        } else {
            echo 0;
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

	private function redirect() {
		header('Location: /mvcaplicado/public/home/index');
	}

    public function login(){
        if (isset($_POST['btnLogin'])) {

            if (Gerente::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A" and idTipoFunc = 1', [$_POST['email'], $_POST['password']])->count() > 0) {
                session_start();
                $_SESSION['dados'] = Gerente::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A" and idTipoFunc = 1', [$_POST['email'], $_POST['password']])->firstOrFail()->toArray();
                header('Location: /mvcaplicado/public/gerente/index');
            } else if (Vendedor::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A" and idTipoFunc = 2', [$_POST['email'], $_POST['password']])->count() > 0) {
				session_start();
                $_SESSION['dados'] = Vendedor::whereRaw('fEmail = ? and fSenha = ? and fStatus = "A" and idTipoFunc = 2', [$_POST['email'], $_POST['password']])->firstOrFail()->toArray();
                header('Location: /mvcaplicado/public/funcionario/index');
            } else if (Vendedor::whereRaw('fEmail = ? and fSenha = ? and fStatus = "R" and idTipoFunc = 2', [$_POST['email'], $_POST['password']])->count() > 0) {
                header('Location: /mvcaplicado/public/funcionario/aguardeAtivacao');
            } else {
                header('Location: /mvcaplicado/public/home/index/loginInvalid');
            }
        }
    } 
    
}
