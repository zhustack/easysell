<!DOCTYPE html>
<html lang="pt-br">
<?php require_once "../app/views/common/head.php"; ?>

<title><?= $data['titlePage']; ?></title>

<body>

	<div class="container h-100 d-flex flex-column justify-content-center align-items-center">

		<span class="display-4 text-light">Cadastre-se</span>

		<form id="formLogin" class="formLogin w-50" action="../home/cadastrar" method="post" enctype="multipart/form-data">
			
				<div class="input-group mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">#</div>
					</div>
					<input type="text" class="form-control" id="name" name="name" placeholder="Nome*" required>
					<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Sobrenome*" required>
				</div>
			
			<div class="form-row">
			<div class="form-group col-md-6">
					<div class="custom-file">
						<input type="file" accept="image/*"  class="custom-file-input" id="photo" name="photo">
						<label class="custom-file-label">Foto de Perfil</label>
					</div>
			</div>

			<div class="form-group col-md-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">#</div>
					</div>
					<input class="form-control" name="birthday" type="date" required>
				</div>
			</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="far fa-address-book"></i></div>
					</div>
					<input class="form-control" type="email" name="email" id="email" placeholder="Digite seu e-mail*" required>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">#</div>
					</div>
					<input class="form-control" type="password" name="senha" id="senha" placeholder="Senha*" required>
				</div>
				</div>
				<div class="form-group col-md-6">
					<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">#</div>
					</div>
					<input class="form-control" type="password" id="passConfirm"placeholder="Confirmar Senha*" required>
				</div>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
				<select class="custom-select" name="tipoConta" id="tipoConta" required>
					<option selected disabled>Eu sou:</option>
					<option value="gerente">Gerente</option>
					<option value="funcionario">Funcionário</option>
				</select>
				</div>
				<div class="form-group col-md-6">
					<input class="form-control" type="email" name="emailGerente" id="emailGerente" placeholder="Email Gerente" disabled>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Cadastrar</button>
		</form>
		<span class="text-muted">Já possui conta? <a href="index">Entre</a>.</span>

	</div>
</body>
<script type="text/javascript">
	document.all.tipoConta.onchange = function() {
		if(document.all.tipoConta.value == "funcionario"){
			document.all.emailGerente.disabled = false;
		}else{
			document.all.emailGerente.disabled = true;
		}
	}

	document.all.passConfirm.onblur = function() {
		if (document.all.passConfirm.value != document.all.senha.value) {
			document.all.passConfirm.value = "";
			document.all.passConfirm.placeholder = "Senha não coincide!";
			document.all.passConfirm.focus();
		}
	}
</script>

</html>