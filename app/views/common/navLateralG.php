<div class="navLateralGerente d-flex flex-column justify-content-center align-items-center h-100">
	<span class="d-flex flex-column justify-content-center align-items-center mb-5 mt-5">
		<img src="/mvcaplicado/public/assets/imgsBanco/<?= $data['imgPerfil'] ?>" id="imgPerfil" class="mt-3 mb-3" />
		<label class="display-3 text-center w-100">Olá, <?= $data['fNome'] ?></label>
	</span>
	<ul class="nav d-inline-block h-75">
		<li class="nav-item">
			<a class="nav-link" href="#"><button class="btn-lg btn-defaultOur dropdown-btn">Vendas  <i class="fa fa-caret-down ml-2"></i></button></a>
			<div class="dropdown-container text-center">
				<a class="nav-link" href="/mvcaplicado/public/venda/index">Registrar Venda</a>
				<a class="nav-link" href="/mvcaplicado/public/venda/grafics">Registros</a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#"><button class="btn-lg btn-defaultOur dropdown-btn">Produtos  <i class="fa fa-caret-down ml-2"></i></button></a>
			<div class="dropdown-container text-center">
				<a class="nav-link" href="/mvcaplicado/public/gerente/cadastrarprodutos">Cadastrar Produtos</a>
				<a class="nav-link" href="/mvcaplicado/public/gerente/produto">Gerenciar Produtos</a>
				<a class="nav-link" href="/mvcaplicado/public/gerente/categoriasemarcas">Categorias e Marcas</a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/mvcaplicado/public/gerente/funcionario"><button class="btn-lg btn-defaultOur dropdown-btn">Equipe</button></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/mvcaplicado/public/gerente/configuracoes"><button class="btn-lg btn-defaultOur dropdown-btn">Configurações</button></a><br>
		</li>
		<li class="nav-item d-flex justify-content-end pr-4">
			<a href="/mvcaplicado/public/gerente/index"><button class="btn-defaultOur mr-3 rounded" style="width: 4em;">Home</button></a>
			<a href="/mvcaplicado/public/gerente/destruir"><button class="btn-defaultOur rounded" style="width: 4em;">Sair</button></a>
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


	var dropdown = document.getElementsByClassName("dropdown-btn");
	var dropdownContent = document.getElementsByClassName("dropdown-container");
	var i;

	for (i = 0; i < dropdown.length; i++) {
  		dropdown[i].addEventListener("click", function() {
    	this.classList.toggle("active");
    	elementoPai = this.parentElement;
    	dropdownC = elementoPai.nextElementSibling;
    	console.log(dropdownC);
    if (dropdownC.style.display === "block") {
      dropdownC.style.display = "none";
    } else {
      dropdownC.style.display = "block";
     }
  });
}
</script>