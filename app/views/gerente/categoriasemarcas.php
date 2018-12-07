<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>

	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php require_once "../app/views/common/navLateralG.php"; ?>
			<div class="general d-flex justify-content-around align-items-center flex-row h-100 p-0">
				<div class="blocoCategoria">
					<label class="display-4 mt-3 mb-0">Categorias</label>
					<table class="table table-hover mt-3">
						<thead class="thead thead-dark text-light">
							<tr>
								<th scope="col">Nome</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody class="table-bordered">
							<?php 
							if (count($data['categorias']) > 0) {
						// print_r($data['funcionarios']);
								foreach ($data['categorias'] as $cat) { ?>
									<tr>
										<input type="hidden" id="<?= $cat['idCategoria']."idCategoria" ?>" class="form-control" name="idCategoria" value="<?=$cat['idCategoria']?>">
										<td><input type="text" id="<?= $cat['idCategoria']."nomeCategoria" ?>" class="form-control" name="ctgrNome" value="<?= str_replace('-', ' ', $cat['ctgrNome']) ?>" ondblclick="ativaInput(this.id)" readonly/></td>
										<td>
											<button class="btn btn-defaultOur btn-sm" name="updateCat" onClick="alterarDadosCat('<?= $cat['idCategoria']."idCategoria"; ?>')">Salvar</button>
											<button onClick="deletarCat('<?= $cat['idCategoria']."idCategoria"; ?>')" class="btn btn-defaultOur btn-sm">Excluir</button></a>
										</td>
									</tr>
									<?php } ?>
									<tr>
										<td><input class="form-control" id="catCriar" type="text" style="cursor: default;" name="ctgrNome" placeholder="Adicione Categorias"></td>
										<td><button onClick="criarCat()" class="btn btn-defaultOur rounded">Adicionar</button></td>
									</tr>

								<?php } else{
									echo "<tr><td colspan='2'><center><b>Adicione categorias através do campo abaixo!</b></center></td></td>";
									echo "<tr ><td><input class='form-control' id='catCriar' type='text' style='cursor: default;' name='ctgrNome' placeholder='Adicione Categorias'></td>
									<td><button onClick='criarCat()' class='btn btn-defaultOur rounded'>Adicionar</button></td></tr>";
								} ?>
							</tbody>
						</table>
					</div>
					<div class="blocoCategoria">
						<label class="display-4 mt-3 mb-0">Marcas</label>
						<table class="table table-hover mt-3">
							<thead class="thead thead-dark text-light">
								<tr>
									<th scope="col">Nome</th>
									<th scope="col">Ações</th>
								</tr>
							</thead>
							<tbody class="table-bordered">
								<?php 
								if (count($data['marcas']) > 0) {
									
						// print_r($data['funcionarios']);
									foreach ($data['marcas'] as $marca) { ?>
										<tr>
											<input type="hidden" id="<?= $marca['idMarca']."idMarca" ?>" class="form-control" name="idMarca" value="<?=$marca['idMarca']?>">
											<td><input type="text" id="<?= $marca['idMarca']."marcaNome" ?>" class="form-control" name="mrcNome" value="<?= str_replace('-', ' ',$marca['mrcNome']) ?>" ondblclick="ativaInput(this.id)" readonly/></td>
											<td>
												<button class="btn btn-defaultOur btn-sm" name="updateMarca" onClick="alterarDadosMarca('<?= $marca['idMarca']."idMarca" ?>')">Salvar</button>
												<button onClick="deletarMarca('<?= $marca['idMarca']."idMarca" ?>')" class="btn btn-defaultOur btn-sm">Excluir</button></a>
											</td>
										</tr>
										<?php } ?>
										<tr>
											<td><input class="form-control" id="marcaCriar" type="text" style="cursor: default;" name="mrcNome" placeholder="Adicione Marcas"></td>
											<td><button onClick="criarMarca()" class="btn btn-defaultOur rounded">Adicionar</button></td>
										</tr>

									<?php } else{
										echo "<tr><td colspan='2'><center><b>Adicione marcas através do campo abaixo!</b></center></td></td>";
										echo "<tr><td><input class='form-control' id='marcaCriar' type='text' style='cursor: default;' name='mrcNome' placeholder='Adicione Marcas'></td>
										<td><button onClick='criarMarca()' class='btn btn-defaultOur rounded'>Adicionar</button></td></tr>";
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
</body>
	<script type="text/javascript">
		function ativaInput(input){
			document.getElementById(input).readOnly = false;
			document.getElementById(input).style.cursor = "default";
		}

		function criarCat() {
			var
				ctgrNome = document.getElementById("catCriar").value.replace(' ', '-');
				conexao = new XMLHttpRequest(),

			conexao.open('GET', '/mvcaplicado/public/categoria/criar/'+ctgrNome);
			conexao.send();

			conexao.onload = function() {
				if(conexao.responseText == 1) {
					location.reload(true);
					alert("Categoria criada com sucesso!");
				} else {
					alert('Categoria já cadastrada!');
					document.getElementById('catCriar').value = '';
					document.getElementById('catCriar').focus();
				}
			}

		}

		function deletarCat($id) {
			if (confirm("Você está prestes a deletar uma categoria, deseja continuar?")) {
				var conexao = new XMLHttpRequest();
				var idCat = parseInt(document.getElementById($id).value);
				conexao.open('GET', '/mvcaplicado/public/categoria/delete/'+idCat);
				conexao.send();
				conexao.onload = function() {
					if(conexao.responseText == 1){
                        location.reload(true);
				    } else {
                        alert("Erro ao buscar categoria!");
                    } 
			     }
		  }
            else {
				 alert("Operação cancelada ;) ");
            }
        }

		function alterarDadosCat($id) {
            let id = parseInt($id);
			var dados = {
		 			"id": ""+document.getElementById(id + "idCategoria").value+"",
		 			"nome": ""+document.getElementById(id +"nomeCategoria").value.replace(' ','-')+""
		 	}
		 	dadosJson = JSON.stringify(dados);
		 	var conexao = new XMLHttpRequest();
		 	conexao.open('GET', '/mvcaplicado/public/categoria/editar/'+dadosJson);
		 	conexao.send();
		 	conexao.onload = function () {
		 		if(conexao.responseText == 1){
					location.reload(true);
					alert("Operação bem sucedida!");
				}else {
					alert('Não foi possível alterar o nome da categoria!');
					// let placeholder = document.getElementById(id +"nomeCategoria").value;
					// document.getElementById(id +"nomeCategoria").value = '';
					// document.getElementById(id +"nomeCategoria").placeholder = placeholder;
					document.getElementById(id +"nomeCategoria").focus();
				}

		 	}
		}

		function criarMarca() {
			var
				mrcNome = document.getElementById("marcaCriar").value.replace(' ', '-');
				conexao = new XMLHttpRequest(),

			conexao.open('GET', '/mvcaplicado/public/marca/criar/'+mrcNome);
			conexao.send();

			conexao.onload = function() {
				if(conexao.responseText == 1) {
					location.reload(true);
					alert("Marca criada com sucesso!");
				} else {
					alert('Marca já cadastrada!');
					document.getElementById('marcaCriar').value = '';
					document.getElementById('marcaCriar').focus();
				}
			}

		}

		function deletarMarca($id) {
			if (confirm("Você está prestes a deletar uma marca, deseja continuar?")) {
				var conexao = new XMLHttpRequest();
				var idMarca = parseInt(document.getElementById($id).value);
				conexao.open('GET', '/mvcaplicado/public/marca/delete/'+idMarca);
				conexao.send();
	
				conexao.onload = function() {
					if(conexao.responseText == 1){
                        location.reload(true);
				    } else {
                        alert("Erro ao buscar marca!");
                    } 
			     }
			} else {
				alert("Operação cancelada ;) ");
			}
		}

		function alterarDadosMarca($id) {
            let id = parseInt($id);
			var dados = {
		 			"id": ""+document.getElementById(id+"idMarca").value+"",
		 			"nome": ""+document.getElementById(id+"marcaNome").value.replace(' ','-')+""
		 	}
		 	dadosJson = JSON.stringify(dados);
		 	var conexao = new XMLHttpRequest();
		 	conexao.open('GET', '/mvcaplicado/public/marca/editar/'+dadosJson);
		 	conexao.send();
		 	conexao.onload = function () {
				if(conexao.responseText == 1) {
		 			location.reload(true);
					 alert("Operação bem sucedida!");
				} else {
					alert('Não foi possível alterar o nome da marca!');
					document.getElementById(id +"marcaNome").focus();
				}
		 	}
		}
	</script>
</html>