<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>
    
	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php require_once "../app/views/common/navLateralG.php"; ?>
			<div class="general d-flex justify-content-start align-items-center flex-column h-100 p-0">
					<label class="display-4 bg-dark text-light rounded p-1 mt-5 mb-0">Produtos</label>
                    <div class="input-group mb-2 mt-2 w-25">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <form id="searchForm" method="get" action="/mvcaplicado/public/gerente/produto">
                            <input id="searchprod" name="searchprod" list="listCodigos" type="text" class="form-control" placeholder="Código do Produto" autocomplete="off">
                        
                        <datalist id="listCodigos">
                            <?php foreach($data['produtos'] as $produto){ ?>
                                <option value="<?= $produto['prdtCodigo']; ?>">
                            <?php } ?>
                        </datalist>
                        </form>
                        <a href="/mvcaplicado/public/gerente/produto"><button class="btn-defaultOur rounded">Listar</button></a>
                    </div>
					<table id="tblProdutos" class="table table-striped mt-3 tabelaProdutos">
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
									<tr data-codigop="<?= $produto['prdtCodigo'] ?>">
                            
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
                                            <select id="<?= $produto['idProduto']."produtoCategoria" ?>" data-catid="<?= $produto['idCategoria'] ?>" class="selectCat custom-select w-100" name="produtoCategoria">
                                                <option value="<?= $produto['idCategoria'];?>"><?= str_replace('-',' ',$produto['ctgrNome']); ?></option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="<?= $produto['idProduto']."produtoMarca" ?>" data-marcaid="<?= $produto['idMarca']?>" class="selectMarca custom-select w-100" name="produtoMarca">
                                                <option value="<?= $produto['idMarca'];?>"><?= str_replace('-', ' ',$produto['mrcNome']); ?></option>
                                            </select>
                                        </td>
										<td class="d-flex flex-row justify-content-between">
											<button class="btn btn-defaultOur btn-sm" name="updateProd" onClick="alterarDadosProd('<?= $produto['idProduto']."idProduto" ?>')"><i class="fas fa-check-square"></i></button>
											<button onClick="deletarProd('<?= $produto['idProduto']."idProduto" ?>')" class="btn btn-defaultOur btn-sm"><i class="fas fa-trash-alt"></i></button>
                                            <a href="/mvcaplicado/public/gerente/produto/detalhes/<?= $produto['idProduto']; ?>"><button class="btn btn-defaultOur btn-sm"><i class="fas fa-search-plus"></i></button></a>
										</td>
									</tr>
									<?php } ?>
									<!--<tr style="background-color: #222">
										
									</tr>-->

								<?php } else{
									echo "<tr style='background-color: #222'><td style='color: #fff' colspan='7'><center>Você ainda não possui produtos cadastrados :( <a href='/mvcaplicado/public/gerente/cadastrarprodutos'>Clique aqui</a> para cadastrar.</center></td></tr>";
								} ?>
							</tbody>
						</table>
            </div>
        </div>
    </body>
    <script>
        
        document.all.searchprod.onkeyup = (event) => {
//            if(event.keycode == '13') {
                
            
                let datalist = document.all.listCodigos;
                let input = document.all.searchprod.value;
                let aux = 0;
            
                for(i=0; i<datalist.options.length;i++) {
                    if(input == datalist.options[i].value) {
                        return true;
                    } else {
                        aux++;
                    }
                }
                if(input.length >= 3 && event.keycode == '13'){
                    if(aux == datalist.options.length) {
                    alert("Produto não cadastrado!");
                }
                    
                }
//            }
        }
        
        function carregaCatP() {
                var selectCat = document.getElementsByClassName("selectCat");
                var conexao = new XMLHttpRequest();
                
                for(c=0; c<selectCat.length;c++){
                    let inicial = selectCat[c].childElementCount;
                    for (i = 0; i < inicial; i++) {
                        selectCat[c].options.remove(selectCat[c].lastChild);
                    }
                }
                 conexao.open('GET', '/mvcaplicado/public/categoria/listAll');
                 conexao.send();
                 conexao.onload = () => {
                      categorias = JSON.parse(conexao.responseText);
                      for(c=0;c<selectCat.length;c++){
                            
                      selectCat[c].insertAdjacentHTML('beforeend', '<option disabled="disabled">Categoria</option>');

                      for(a=0;a<categorias.length;a++){
                         if(selectCat[c].getAttribute('data-catid') == categorias[a].idCategoria) {
                            selectCat[c].insertAdjacentHTML('beforeend','<option selected value='+categorias[a].idCategoria+'>'+categorias[a].ctgrNome.replace('-',' ')+'</option>'); 
                         } else {
                            selectCat[c].insertAdjacentHTML('beforeend','<option value='+categorias[a].idCategoria+'>'+categorias[a].ctgrNome.replace('-',' ')+'</option>');
                         }
                      }
                      selectCat[c].insertAdjacentHTML('beforeend', '<option value="add">Adicionar</option>');               
                
                }
                }       
        }
        
         function  carregaMarcaP() {
                var selectMarca = document.getElementsByClassName("selectMarca");
                var conexao = new XMLHttpRequest();
                
                for(c=0; c<selectMarca.length;c++){
                    let inicial = selectMarca[c].childElementCount;
                    for (i = 0; i < inicial; i++) {
                        selectMarca[c].options.remove(selectMarca[c].lastChild);
                    }
                }
                 conexao.open('GET', '/mvcaplicado/public/marca/listAll/');
                 conexao.send();
                 conexao.onload = () => {
                      marcas = JSON.parse(conexao.responseText);
                      for(c=0;c<selectMarca.length;c++){
                            
                      selectMarca[c].insertAdjacentHTML('beforeend', '<option disabled="disabled">Marca</option>');

                      for(a=0;a<marcas.length;a++){
                        if(selectMarca[c].getAttribute('data-marcaid') == marcas[a].idMarca){
                            selectMarca[c].insertAdjacentHTML('beforeend','<option selected value='+marcas[a].idMarca+'>'+marcas[a].mrcNome.replace('-',' ')+'</option>');
                        } else {
                            selectMarca[c].insertAdjacentHTML('beforeend','<option   value='+marcas[a].idMarca+'>'+marcas[a].mrcNome.replace('-',' ')+'</option>');
                        }
                      }
                      selectMarca[c].insertAdjacentHTML('beforeend', '<option value="add">Adicionar</option>');               
                
                }
                }       
        }
        
        carregaCatP();
        carregaMarcaP();
        
        function alterarDadosProd($id) {
            let id = parseInt($id);
			var dados = {
		 			"id": ""+document.getElementById(id+"idProduto").value+"",
		 			"codigo": ""+document.getElementById(id+"produtoCodigo").value+"",
		 			"nome": ""+document.getElementById(id+"produtoNome").value.replace(' ','-').replace(' ','-')+"",
		 			"valor": ""+document.getElementById(id+"produtoValor").value+"",
		 			"quantidade": ""+document.getElementById(id+"produtoQtde").value+"",
		 			"categoria": ""+document.getElementById(id+"produtoCategoria").value+"",
		 			"marca": ""+document.getElementById(id+"produtoMarca").value+"",
		 	}
		 	dadosJson = JSON.stringify(dados);
		 	var conexao = new XMLHttpRequest();
		 	conexao.open('GET', '/mvcaplicado/public/produto/editar/'+dadosJson);
		 	conexao.send();
		 	conexao.onload = function () {
		 		location.reload(true);
		 		// console.log(conexao.responseText);
		 	}
		 	// console.log(dadosJson);
        }
        
        function deletarProd($id) {
			if (confirm("Você está prestes a deletar um produto, deseja continuar?")) {
				var conexao = new XMLHttpRequest();
				var idProduto = parseInt(document.getElementById($id).value);
				conexao.open('GET', '/mvcaplicado/public/produto/delete/'+idProduto);
				conexao.send();
				// location.reload(true);
				conexao.onload = function() {
					if(!isNaN(conexao.responseText)){
                        location.reload(true);
				    } else {
                        alert("Erro ao tentar excluir!");
                    } 
			     }
			} else {
				alert("Operação cancelada ;) ");
			}
		}
        
 /*       document.all.searchprod.onkeyup = () => {
            
            let input = document.all.searchprod.value;
            let trTabela = document.all.tblProdutos.children[1].children;
            
            console.log(trTabela[0].children);
            
            for(i=0; i < trTabela.length;i++){
//                console.log(trTabela[i]);
                if(trTabela[i].getAttribute('data-codigop') != input) {
                    trTabela[i].style.display = 'none';
                    for(c=0; c < trTabela[i].children;i++){
                        trTabela[i].children[c].style.visibility = 'hidden';
                    }
                } else {
                    trTabela[i].style.display = 'block';
                    for(c=0; c < trTabela[i].children;i++){
                        trTabela[i].children[c].style.visibility = 'visible';
                    }
                }
            }
//            console.log(trTabela);
            
        }
*/        
    </script>
        <?php if($data['msg'] == 1) {
            echo "<script type='text/javascript'>alert('Produto não encontrado!');</script>";
         } ?>
</html>