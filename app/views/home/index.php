<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-br">
<?php require_once "../app/views/common/head.php"; ?>

<body>
	<div class="container h-100 w-100 d-flex flex-column justify-content-center align-items-center">
	<span class="display-4 text-light">Acesse o EasySell</span>
	<form id="formLogin" class="formLogin " action="/mvcaplicado/public/home/login" enctype="multipart/form-data" method="post">
		
			<div class="input-group mb-2 mt-2">
				<div class="input-group-prepend">
					<div class="input-group-text">#</div>
				</div>
				<input type="email" class="form-control" id="email" name="email" placeholder="E-mail*" required>
			</div>

			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text">#</div>
				</div>
				<input type="password" class="form-control" id="password" name="password" placeholder="Senha*" required>
			</div>
			<!-- <div class="form-group d-flex flex-row justify-content-between">
				<select class="custom-select col-sm-5" name="tipoConta" id="tipoConta" required>
					<option selected disabled>Eu sou:</option>
					<option value="gerente">Gerente</option>
					<option value="funcionario">Funcionário</option>
				</select>
			</div> -->
				<button name="btnLogin" class="btn btn-primary col-sm-6">Entrar</button>
				<center>><label class="text-warning mt-2"><?php if($data['error']){echo 'Login e/ou senha incorreto!';}?></label></center
	</form>
	<span class="text-muted">Não possui conta? <a href="/mvcaplicado/public/home/cadastrar">Cadastre-se</a>.</span>
</div>
</body>

</html>