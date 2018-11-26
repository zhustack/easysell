<!Doctype html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>
	
	<body>
		<div class="container-fluid d-flex flex-row p-0 m-0 h-100 w-100">
			<?php require_once "../app/views/common/navLateralG.php"; ?>
			<div class="general blocoFuncionalidade h-100 pl-5 pr-5 bg-white justify-content-center align-items-center d-flex flex-wrap">
				<div class="container-fluid d-flex justify-content-center align-items-end flex-row h-50">
				<a href="/mvcaplicado/public/venda/index"><div class="funcionalidadeGerente rounded">
				<i class="fas fa-hand-holding-usd fa-5x"></i><br>
					<label class="display-4">Caixa</label>
				</div></a>
				<a href="/mvcaplicado/public/gerente/produto"><div class="funcionalidadeGerente rounded">
				<i class="fas fa-box-open fa-5x"></i><br>
					<label class="display-4">Estoque</label>
				</div></a>
			</div>
			<div class="container-fluid d-flex justify-content-center align-items-start flex-row h-50">
				<a href="../gerente/funcionario"><div class="funcionalidadeGerente rounded">
					<i class="fas fa-users fa-5x"></i><br>
					<label class="display-4">Equipe</label>
				</div></a>
				<a href="#"><div class="funcionalidadeGerente rounded">
					<i class="fas fa-cogs fa-5x"></i><br>
					<label class="display-4">Configurações</label>
				</div></a>
			</div>
			</div>
		</div>
	</body>
</html>