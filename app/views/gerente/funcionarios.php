<!DOCTYPE html>
<html lang="pt-br">
<?php require_once "../app/views/common/head.php"; ?>

	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-row">
		<?php require_once "../app/views/common/navLateralG.php"; ?>
			<div class="general d-flex justify-content-center align-items-center flex-column">
				<div class="blocoFuncionario d-flex justify-content-start align-items-center flex-column">
				<label class="display-4 mt-3 mb-0">Relação de Liderados</label>
				<table class="table table-bordered mt-3">
					<thead class="thead-dark">
						<tr>
							<th style="width: 8em;" scope="col">Código</th>
							<th scope="col">Nome</th>
							<th scope="col">Email</th>
							<th scope="col">Situação</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody class="table-hover">
						<?php 
							if (count($data['funcionarios']) > 0) {
							$i = 0;
							// print_r($data['funcionarios']);
							foreach ($data['funcionarios'] as $func) { ?>
							<tr>
								<input type="hidden" id="<?= $i."id" ?>" class="form-control" name="idFuncionario" value="<?=$func['idFuncionario']?>">
								<th scope="row"><input type="text" id="<?= $i."codigo" ?>" class="form-control" name="fCodigo" placeholder="Atribuir" value="<?=$func['fCodigo']?>" ondblclick="ativaInput(this.id)" readonly/></th>
								<td><input type="text" id="<?= $i."nome" ?>" class="form-control" name="fNome" value="<?=$func['fNome']?>" ondblclick="ativaInput(this.id)" readonly/></td>
								<td><input type="text" id="<?= $i."email" ?>" class="form-control" name="fEmail" value="<?=$func['fEmail']?>" ondblclick="ativaInput(this.id)" readonly="true"/></td>
								<td>
									<select id="<?= $i."status" ?>" class="custom-select" name="fStatus">
										<?php 
											switch ($func['fStatus']) {
												case 'I':
													echo "<option value='I' selected>Inativo</option>";
													echo "<option value='A'>Ativo</option>";
													echo "<option value='R'>Solicitado</option>";
													break;
												case 'R':
													echo "<option value='R' selected>Solicitado</option>";
													echo "<option value='A'>Ativo</option>";
													echo "<option value='I'>Inativo</option>";
													break;
												default:
													echo "<option value='A' selected>Ativo</option>";
													echo "<option value='R' >Solicitado</option>";
													echo "<option value='I'>Inativo</option>";
													break;
											}
										?>
									</select>
								</td>
								<td style="width: 9.5em !important;">
									<button class="btn btn-defaultOur btn-sm" name="updateFunc" onClick="alterarDadosFunc(<?= $i ?>)">Salvar</button>
									<button type="submit" onClick="deletarFunc(<?= $i ?>)" class="btn btn-outline-primary btn-sm">Excluir</button></a>
								</td>
							</tr>
						<?php $i++; } } else{
							echo "<tr><td colspan='5'><center>Não há liderados em seu nome!</center></td></tr>";
						} ?>
					</tbody>
				</table>
					</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">

		function alterarDadosFunc($id) {
			if (document.getElementById($id+"codigo").value == "") {
				alert("Deve-se atribuir um código ao funcionário antes de alterar suas informações!");
			}
		 	var dados = {
		 			"id": ""+document.getElementById($id+"id").value+"",
		 			"codigo": ""+document.getElementById($id+"codigo").value+"", 
		 			"nome": ""+document.getElementById($id+"nome").value+"",
		 			"email": ""+document.getElementById($id+"email").value+"",
		 			"status": ""+document.getElementById($id+"status").value+""
		 	}
		 	dadosJson = JSON.stringify(dados);
		 	var conexao = new XMLHttpRequest();
		 	conexao.open('GET', '/mvcaplicado/public/funcionario/editar/'+dadosJson);
		 	conexao.send();
		 	conexao.onload = () => {
		 		location.reload(true);
		 	}
		}

		function deletarFunc($id) {
			if (confirm("Você está prestes a deletar um liderado, deseja continuar?")) {
				var conexao = new XMLHttpRequest();
				var idFunc = document.getElementById($id+"id").value;
				conexao.open('GET', '/mvcaplicado/public/funcionario/delete/'+idFunc);
				conexao.send();
				conexao.onload = () => {
					location.reload(true);
				}
		
			} else {
				alert("Operação cancelada ;) ");
			}
		}
	</script>
</html>