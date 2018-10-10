<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>

	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php require_once "../app/views/common/navLateralG.php"; ?>
			<div class="general d-flex justify-content-center align-items-center flex-row h-100 p-0">
				<div class="blocoCategoria">
					<label class="display-4 bg-dark text-light rounded p-1 mt-5 mb-0">Categorias</label>
					<table class="table table-striped mt-3">
						<thead class="thead text-light" style="background-color: #222">
							<tr>
								<th scope="col">Nome</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody>
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
									<tr style="background-color: #ccc">
										<td><input class="form-control" id="catCriar" type="text" style="cursor: default; background-color: #ddd; color: black" name="ctgrNome" placeholder="Adicione Categorias"></td>
										<td><button onClick="criarCat()" class="btn btn-defaultOur rounded">Adicionar</button></td>
									</tr>

								<?php } else{
									echo "<tr style='background-color: #ccc'><td><input class='form-control' id='catCriar' type='text' style='cursor: default; background-color: #ddd; color: black' name='ctgrNome' placeholder='Adicione Categorias'></td>
									<td><button onClick='criarCat()' class='btn btn-defaultOur rounded'>Adicionar</button></td></tr>";
								} ?>
							</tbody>
						</table>
					</div>
					<div class="blocoCategoria">
						<label class="display-4 bg-dark text-light rounded p-1 mt-5 mb-0">Marcas</label>
						<table class="table table-striped mt-3">
							<thead class="thead text-light" style="background-color: #222">
								<tr>
									<th scope="col">Nome</th>
									<th scope="col">Ações</th>
								</tr>
							</thead>
							<tbody>
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
										<tr style="background-color: #ccc">
											<td><input class="form-control" id="marcaCriar" type="text" style="cursor: default; background-color: #ddd; color: black" name="mrcNome" placeholder="Adicione Marcas"></td>
											<td><button onClick="criarMarca()" class="btn btn-defaultOur rounded">Adicionar</button></td>
										</tr>

									<?php } else{
										echo "<tr style='background-color: #ccc'><td><input class='form-control' id='marcaCriar' type='text' style='cursor: default; background-color: #ddd; color: black' name='mrcNome' placeholder='Adicione Marcas'></td>
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
				dados = {
					"idFuncionario":"<?= $data['idFuncionario'] ?>",
					"ctgrNome":""+ctgrNome+""
				};
			dadosJSON = JSON.stringify(dados);

			conexao.open('GET', '/mvcaplicado/public/categoria/criar/'+dadosJSON);
			conexao.send();

			conexao.onload = function() {
				location.reload(true);
			}

		}

		function deletarCat($id) {
			if (confirm("Você está prestes a deletar uma categoria, deseja continuar?")) {
				var conexao = new XMLHttpRequest();
				var idCat = parseInt(document.getElementById($id).value);
				conexao.open('GET', '/mvcaplicado/public/categoria/delete/'+idCat);
				conexao.send();
				// location.reload(true);
				conexao.onload = function() {
					if(!isNaN(conexao.responseText)){
                        location.reload(true);
				    } else {
                        alert("Certifique-se de excluir os produtos ligados a esta categoria!");
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
		 		location.reload(true);
		 		// console.log(dadosJson);
		 	}
		 	// console.log(dadosJson);
		}

		function criarMarca() {
			var
				mrcNome = document.getElementById("marcaCriar").value.replace(' ', '-');
				conexao = new XMLHttpRequest(),
				dados = {
					"idFuncionario":"<?= $data['idFuncionario'] ?>",
					"mrcNome":""+mrcNome+""
				};
			dadosJSON = JSON.stringify(dados);

			conexao.open('GET', '/mvcaplicado/public/marca/criar/'+dadosJSON);
			conexao.send();

			conexao.onload = function() {
				location.reload(true);
			}

		}

		function deletarMarca($id) {
			if (confirm("Você está prestes a deletar uma marca, deseja continuar?")) {
				var conexao = new XMLHttpRequest();
				var idMarca = parseInt(document.getElementById($id).value);
				conexao.open('GET', '/mvcaplicado/public/marca/delete/'+idMarca);
				conexao.send();
				// location.reload(true);
				conexao.onload = function() {
					if(!isNaN(conexao.responseText)){
                        location.reload(true);
				    } else {
                        alert("Certifique-se de excluir os produtos ligados a esta marca!");
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
		 		location.reload(true);
		 		// console.log(conexao.responseText);
		 	}
		 	// console.log(dadosJson);
		}
	</script>
</html>