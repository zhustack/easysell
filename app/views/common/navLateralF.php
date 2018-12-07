<div class="navLateralGerente d-flex flex-column justify-content-center align-items-center h-100">
	<span class="d-flex flex-column justify-content-center align-items-center mb-5 mt-5">
		<img src="/mvcaplicado/public/assets/imgsBanco/<?= $data['imgPerfil'] ?>" id="imgPerfil" class="mt-3 mb-3" />
		<label class="display-3 text-center w-100">Olá, <?= $data['fNome'] ?></label>
	</span>
	<ul class="nav d-inline-block h-75">
		<li class="nav-item">
			<a class="nav-link" href="/mvcaplicado/public/venda/index"><button class="btn-lg btn-defaultOur dropdown-btn">Vender</button></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/mvcaplicado/public/funcionario/produto"><button class="btn-lg btn-defaultOur dropdown-btn">Produtos</button></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/mvcaplicado/public/funcionario/configuracoes"><button class="btn-lg btn-defaultOur dropdown-btn">Configurações</button></a><br>
		</li>
		<li class="nav-item d-flex justify-content-end pr-4">
			<a href="/mvcaplicado/public/funcionario/index"><button class="btn-defaultOur mr-3 rounded" style="width: 4em;">Home</button></a>
			<a href="/mvcaplicado/public/funcionario/destruir"><button class="btn-defaultOur rounded" style="width: 4em;">Sair</button></a>
		</li>
	</ul>
</div>
<script type="text/javascript">

	document.body.onload = () => {
		if(document.all.imgPerfil.src == "http://127.0.0.1/mvcaplicado/public/assets/imgsBanco/default.png") {
		document.all.imgPerfil.style.height = '8em';
		document.all.imgPerfil.style.width = '8em';
	} else {
		document.all.imgPerfil.style.height = '8.5em';
		document.all.imgPerfil.style.width = '8.5em';
	}
	}

</script>