<!DOCTYPE html>
<html lang="pt-br">
<?php require_once "../app/views/common/head.php"; ?>

<title><?= $data['titlePage']; ?></title>

<body>
	
	<div class="container-fluid h-100 d-flex flex-row w-100 p-0 m-0">

		<?php require_once "../app/views/common/navLateralG.php"; ?>
		<div class="general h-100 d-flex flex-column justify-content-start align-items-center">
			<form id="formLogin" class="w-50 mt-5" action="/mvcaplicado/public/gerente/configuracoes" method="post" enctype="multipart/form-data">
			<center><label class="display-4 p-1 mb-3 rounded text-light bg-dark w-100">Configurações</label></center>
				<input type="hidden" value="<?= $data['dadosFuncionario']['idFuncionario'];?>" name="idGerente" />
				<div class="input-group input-group-lg w-100 mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">#</div>
					</div>
					<input type="text" class="form-control" id="fNome" name="fNome" value="<?= $data['dadosFuncionario']['fNome'];?>" placeholder="Nome*" ondblclick="ativaInput(this.id)" readOnly required>
				</div>
			
				<div class="input-group input-group-lg w-100 mb-2 ">
					<div class="input-group-prepend">
						<div class="input-group-text">#</div>
					</div>
					<input type="text" class="form-control" id="fSobrenome" name="fSobrenome" ondblclick="ativaInput(this.id)"  value="<?= $data['dadosFuncionario']['fSobrenome'];?>" readOnly placeholder="Sobrenome*" required>
				</div>


					<div class="custom-file form-control-lg mb-2 w-100">
						<input type="file" accept="image/*" class="custom-file-input" id="fFoto" name="fFoto">
						<label class="custom-file-label" style="height:39px">Foto de Perfil</label>
					</div>

				<div class="input-group input-group-lg w-100 mb-2 ">
					<div class="input-group-prepend">
						<div class="input-group-text">#</div>
					</div>
					<input class="form-control" name="fDataNasc" id="fDataNasc" ondblclick="ativaInput(this.id)"  value="<?= $data['dadosFuncionario']['fDataNasc'];?>" type="date" readOnly required>
				</div>

				<div class="input-group input-group-lg mb-2 w-100">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="far fa-address-book"></i></div>
					</div>
					<input class="form-control" value="<?= $data['dadosFuncionario']['fEmail'];?>" type="email" name="fEmail" id="fEmail" ondblclick="ativaInput(this.id)" placeholder="Digite seu e-mail*" readOnly required>
				</div>


				<div class="input-group input-group-lg w-50 mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">#</div>
					</div>
					<input class="form-control" type="password" name="fSenha" id="fSenha" placeholder="Nova Senha*">
				</div>

				<div class="input-group input-group-lg w-50 mb-2">
					<div class="input-group-prepend">
						<div class="input-group-text">#</div>
					</div>
					<input class="form-control" type="password" id="passConfirm" placeholder="Confirmar Nova Senha*">
				</div>


			<button type="submit" class="btn btn-primary">Salvar</button>
		</form>
		</div>
	</div>
</body>
<script type="text/javascript">

	document.all.passConfirm.onblur = function() {
		if (document.all.passConfirm.value != document.all.fSenha.value) {
			document.all.passConfirm.value = "";
			document.all.passConfirm.placeholder = "Senha não coincide!";
			document.all.passConfirm.focus();
		}
	}
</script>

</html>