<!DOCTYPE html>
<html lang="pt-br">
<?php require_once "../app/views/common/head.php"; ?>

<title><?= $data['titlePage']; ?></title>

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

.formCad {
	height: 30em;
	display: flex;
	flex-direction: column;
	justify-content: center;
	background-color: #fff;
	padding: 0 3em;
	border-radius: 0.75em;
	box-shadow: 0 0 10px #333;
	/* align-items: center; */
}

.formCad .display-4 {
	color: #000;
	font-size: 245%;
}

.formCad input, .formCad select {
	border: 0;
	border-bottom: 2px solid;
	background: transparent !important;
	outline-width: 0 !important;
	transition: 0.1s;
}
.formCad .input-group-text {
	border: 0;
	border-bottom: 2px solid;
	background: transparent !important;
}
.formCad input:focus, .formCad select:hover{
	border-color: #009999;
	background-color: transparent;
	border-width: 2.5px;
	transition: 0.1s;
}

.formCad a {
	color: #111 !important;
	font-weight: bolder;
}

</style>

<body>

	<div class="bgOur h-100 d-flex flex-column justify-content-center align-items-center">

	<form id="formLogin" name ="formLogin" class="formCad" action="/mvcaplicado/public/home/processa_cadastro" method="post" enctype="multipart/form-data">
	
		<center><span class="display-4">Cadastre-se</span></center>
			<div class="form-row mt-3">
				<div class="form-group col-md-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-user"></i></div>
						</div>
						<input type="text" class="form-control" id="name" name="name" placeholder="Nome*" required>
					</div>
				</div>

				<div class="form-group col-md-6">
				<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-user"></i></div>
						</div>
						<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Sobrenome*" required>
					</div>
				</div>
			</div>
			
			<div class="form-row">

			<div class="form-group col-md-6">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-birthday-cake"></i></div>
					</div>
					<input class="form-control" name="birthday" type="date" required>
				</div>
			</div>
			<div class="form-group col-md-6">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-camera"></i></div>
						</div>
						<input type="file" accept="image/*"  class="form-control" id="photo" name="photo">
						<!--label class="custom-file-label">Foto de Perfil</label>-->
					</div>
			</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-at"></i></div>
					</div>
					<input class="form-control" type="email" name="email" id="email" placeholder="Digite seu e-mail*" required>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-lock"></i></div>
					</div>
					<input class="form-control" type="password" name="senha" id="senha" placeholder="Senha*" required>
				</div>
				</div>
				<div class="form-group col-md-6">
					<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-lock"></i></div>
					</div>
					<input class="form-control" type="password" id="passConfirm"placeholder="Confirmar Senha*" required>
				</div>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
				<select class="custom-select" name="tipoConta" id="tipoConta" required>
					<option value="0" selected disabled>Eu sou:</option>
					<option value="gerente">Gerente</option>
					<option value="funcionario">Funcionário</option>
				</select>
				</div>
				<div class="form-group col-md-6">
					<input class="form-control" type="email" name="emailGerente" id="emailGerente" placeholder="Email Gerente" disabled>
				</div>
			</div>
			<button type="submit" id="btnEnviar" style="width: 7em" onclick="fnExisteGerente()" class="btn btn-defaultOur">Cadastrar</button>
			<center><span class="">Já possui conta? <a href="index">Entre</a>.</span></center>
		</form>

	</div>
</body>
<script type="text/javascript">

	document.formLogin.onsubmit = ()=>{return tipoContaSelected();}

	function tipoContaSelected() {
		if(document.all.tipoConta.value == 0) {
			alert('Selecione seu tipo de conta! E clique em cadastrar!');
			return false;
		} else {
			return true;
		}
	}
	

	document.all.tipoConta.onchange = function() {
		if(document.all.tipoConta.value == "funcionario"){
			document.all.emailGerente.disabled = false;
			document.all.emailGerente.required = true;
			document.all.btnEnviar.type="button";
			document.all.emailGerente.style.cursor = 'text';
		}else{
			document.all.emailGerente.required = false;
			document.all.emailGerente.disabled = true;
			document.all.emailGerente.style.cursor = 'no-drop';
			document.all.btnEnviar.type="submit";

		}
	}

	document.all.passConfirm.onblur = function() {
		if (document.all.passConfirm.value != document.all.senha.value) {
			document.all.passConfirm.value = "";
			document.all.passConfirm.placeholder = "Senha não coincide!";
			document.all.passConfirm.focus();
		}
	}

	function fnExisteGerente() {
		if(document.all.tipoConta.value == "funcionario") {
			email = document.all.emailGerente.value;
			const conn = new XMLHttpRequest();
			conn.open('GET', '/mvcaplicado/public/home/buscaEmailG/' + document.all.emailGerente.value);
			conn.send();

			conn.onload = () => {
				if(conn.responseText == 0) {
					document.all.emailGerente.value = "";
					document.all.emailGerente.placeholder = "Líder não encontrado!";
					document.all.emailGerente.style.borderBottom = "5px solid red";
					alert("Email não encontrado!");
					document.all.emailGerente.focus();
					
				} else {
					document.formLogin.submit();
				}
			} 
		}

	} 	
</script>

</html>