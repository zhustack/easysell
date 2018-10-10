<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>
    
	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php require_once "../app/views/common/navLateralG.php"; ?>
			<div class="general d-flex justify-content-start align-items-center flex-column h-100 p-0">
					<label class="display-4 bg-dark text-light rounded p-1 mt-5 mb-0">Produtos</label>
					<table class="table table-striped mt-3 tabelaProdutos">
						<thead class="thead text-light" style="background-color: #222">
							<tr>
								<th scope="col">Código</th>
								<th scope="col">Nome</th>
								<th scope="col">Valor</th>
								<th scope="col">Qtd.</th>
								<th scope="col">Categoria</th>
								<th scope="col">Marca</th>
								<th scope="col">Ações</th>
<!--								<th scope="col"><?p= $data['params'];?></th>-->
                                
							</tr>
						</thead>
						<tbody>
							<?php 
							if (count($data['produtos']) > 0) {
						// print_r($data['funcionarios']);
								foreach ($data['produtos'] as $produto) { ?>
									<tr>
                            
										<input type="hidden" id="<?= $produto['idProduto']."idProduto" ?>" class="form-control" name="idProduto" value="<?=$produto['idProduto']?>">
										<td>
                                            <input type="text" id="<?= $produto['idProduto']."produtoCodigo" ?>" class="form-control form-control-sm" name="produtoCodigo" value="<?= str_replace('-', ' ', $produto['prdtCodigo']) ?>" ondblclick="ativaInput(this.id)" readonly/>
                                        </td>
                                        <td>
                                            <input type="text" id="<?= $produto['idProduto']."produtoNome" ?>" class="form-control form-control-sm" name="produtoNome" value="<?= str_replace('-', ' ', $produto['prdtNome']) ?>" ondblclick="ativaInput(this.id)" readonly/>
                                        </td>
                                        <td>
                                            <input type="text" id="<?= $produto['idProduto']."produtoValor" ?>" class="form-control form-control-sm" name="produtoValor" value="<?= str_replace('-', ' ', $produto['prdtValor']) ?>" ondblclick="ativaInput(this.id)" readonly/>
                                        </td>
                                        <td>
                                            <input type="text" id="<?= $produto['idProduto']."produtoQtde" ?>" class="form-control form-control-sm" name="produtoQtde" value="<?= str_replace('-', ' ', $produto['prdtQuantidade']) ?>" ondblclick="ativaInput(this.id)" readonly/>
                                        </td>
                                        <td style="width: 10em;">
                                            <select id="<?= $produto['idProduto']."produtoCategoria" ?>" class="selectCat custom-select w-100" name="fStatus">
                                                <option value="<?= $produto['idCategoria'];?>"><?= str_replace('-', ' ',$produto['ctgrNome']); ?></option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="<?= $produto['idProduto']."produtoMarca" ?>" class="form-control form-control-sm" name="produtoMarca" value="<?= str_replace('-', ' ', $produto['mrcNome']) ?>" ondblclick="ativaInput(this.id)" readonly/>
                                        </td>
										<td class="d-flex flex-row justify-content-between">
											<button class="btn btn-defaultOur btn-sm" name="updateProd" onClick="alterarDadosProd(<?= $produto['idProduto']."idProduto" ?>)"><i class="fas fa-check-square"></i></button>
											<button onClick="deletarProd(<?= $produto['idProduto']."idProduto" ?>)" class="btn btn-defaultOur btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            <a href="produto/detalhes/<?= $produto['idProduto']; ?>"><button class="btn btn-defaultOur btn-sm"><i class="fas fa-search-plus"></i></button></a>
										</td>
									</tr>
									<?php } ?>
									<!--<tr style="background-color: #222">
										<td><input class="form-control" id="catCriar" type="text" style="cursor: default; background-color: #ddd; color: black" name="ctgrNome" placeholder="Adicione Categorias"></td>
										<td><button onClick="criarCat()" class="btn btn-defaultOur rounded">Adicionar</button></td>
									</tr>-->

								<?php } else{
									echo "<tr style='background-color: #222'><td><input class='form-control' id='catCriar' type='text' style='cursor: default; background-color: #ddd; color: black' name='ctgrNome' placeholder='Adicione Categorias'></td>
									<td><button onClick='criarCat()' class='btn btn-defaultOur rounded'>Adicionar</button></td></tr>";
								} ?>
							</tbody>
						</table>
            </div>
        </div>
    </body>
    <script>

        function carregaCatP() {
                var selectCat = document.getElementsByClassName("selectCat");
                var conexao = new XMLHttpRequest();
                
                for(c=0; c<selectCat.length;c++){
                    let inicial = selectCat[c].childElementCount;
                    for (i = 0; i < inicial; i++) {
                        selectCat[c].options.remove(selectCat[c].lastChild);
                    }
                }
                 conexao.open('GET', '/mvcaplicado/public/categoria/listAll/<?=$data["idFuncionario"] ?>');
                 conexao.send();
                 conexao.onload = () => {
                      categorias = JSON.parse(conexao.responseText);
                      for(c=0;c<selectCat.length;c++){
                            
                      selectCat[c].insertAdjacentHTML('beforeend', '<option disabled="disabled">Categoria</option>');

                      for(a=0;a<categorias.length;a++){
                         selectCat[c].insertAdjacentHTML('beforeend','<option value='+categorias[a].idCategoria+'>'+categorias[a].ctgrNome.replace('-',' ')+'</option>');
                      }
                      selectCat[c].insertAdjacentHTML('beforeend', '<option value="add">Adicionar</option>');               
                
                }
                }       
        }
        
        carregaCatP();
        
        function alteraProduto($id) {
            let id = parseInt($id);
			var dados = {
		 			"id": ""+document.getElementById(id+"idProduto").value+"",
		 			"codigo": ""+document.getElementById(id+"idProduto").value+"",
		 			"nome": ""+document.getElementById(id+"produtoNome").value.replace(' ','-')+""
		 			"valor": ""+document.getElementById(id+"produtoValor").value+"",
		 			"quantidade": ""+document.getElementById(id+"produtoQuantidade").value+"",
		 			"categoria": ""+document.getElementById(id+"idProduto").value+"",
		 			"id": ""+document.getElementById(id+"idProduto").value+"",
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