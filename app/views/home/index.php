<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-br">
<?php require_once "../app/views/common/head.php"; ?>
<style>
	body {
		background-color: #111;
		background-image: url('/mvcaplicado/public/assets/imgs/home1.jpg');
		background-size: 100% 100%;
		background-repeat: no-repeat;
		padding: 0 !important;
	}
	.bgOur {
		background: rgba(0,0,0,0.5) !important;
		width: 100% !important;
		margin: 0 !important;
	}

	.formLogin {
		height: 27.5em;
		width: 32.5%;
		display: flex;
		flex-direction: column;
		justify-content: flex-end;
		align-items: center;
		padding: 0 3.25em 4em 3.25em;
		border-radius: 0.75em;
		background-color: #fff;
		box-shadow: 0 0 10px #333;
	}

	.formLogin div{
		outline: none !important;
	}

	.formLogin input {
		border: 0;
		border-bottom: 2px solid;
		background: transparent;
		outline-width: 0 !important;
		transition: 0.1s;
	}
	.formLogin .input-group-text {
		border: 0;
		border-bottom: 2px solid;
		background: transparent;
	}
	.formLogin img {
		height: 35%;
		width: 75%;
		margin-bottom: 1.75em;
	}
	.formLogin .display-3 {
		margin-bottom: 0.5em;
	}
	.formLogin a {
		color: #111 !important;
		font-weight: bolder;
	}
	.formLogin input:focus{
		border-color: #009999;
		background-color: transparent;
		border-width: 2.5px;
		transition: 0.1s;
	}
	.formLogin .erroAviso {
		font-size: 1.25em;
	}

	
	
</style>
<body>
	<div class="bgOur h-100 w-100 d-flex flex-column justify-content-center align-items-center">
	<form id="formLogin" class="formLogin" action="/mvcaplicado/public/home/login" enctype="multipart/form-data" method="post">
	<img src="/mvcaplicado/public/assets/imgs/logotipo.png"/> 
	<!-- <span class="display-3">Entrar</span>-->
			<div class="input-group mb-2 mt-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-user"></i></div>
				</div>
				<input type="email" class="form-control" id="email" name="email" placeholder="E-mail*" autocomplete="off" required>
			</div>

			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-lock"></i></div>
				</div>
				<input type="password" class="form-control" id="password" name="password" placeholder="Senha*" required>
			</div>
			<button name="btnLogin" style="width: 5em" class="btn btn-primary">Entrar</button>
			<?php if($data['message'] == 2){echo '<center><label class="mt-2 erroAviso"> Login e/ou senha incorreto! <i class="fas fa-exclamation-triangle"></i></label></center>';}?>
			<span class="mt-1">Não possui conta? <a href="/mvcaplicado/public/home/cadastrar">Cadastre-se</a>.</span>
	</form>
</div>
</body>
<?php 
	if($data['message'] == -1) {
		echo "<script language='javascript' type='text/javascript'>alert('Email já cadastrado\\nEfetue seu login!');</script>";
	}

	if($data['message'] == 1) {
		echo "<script language='javascript' type='text/javascript'>alert('Cadastro realizado com sucesso!');</script>";
	}

?>
</html>