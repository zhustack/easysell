<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>
    
	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php require_once "../app/views/common/navLateralG.php"; ?>
			<div class="general d-flex justify-content-start align-items-center flex-column h-100 p-0">
					<label style="font-size: 250%;" class="display-4 text-white bg-dark rounded p-1 mt-5 w-75 mb-0"><center>Produtos</center></label>
                    <form id="searchForm" class="d-flex pl-5 w-100 align-items-start" method="get" action="/mvcaplicado/public/gerente/produto">
                    <div style="width:32%" class="input-group ml-1 mt-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                            <input id="searchprod" name="searchprod" list="listCodigos" type="text" class="form-control" placeholder="Código do Produto" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text btn-defaultOur"><a style="	text-decoration: none;
	color: #fff;" href="/mvcaplicado/public/gerente/produto">Listar Todos</a></span>
                            </div>
                        <datalist id="listCodigos">
                            <?php foreach($data['produtos'] as $produto){ ?>
                                <option value="<?= $produto['prdtCodigo']; ?>">
                            <?php } ?>
                        </datalist>
                        
                    </div>
                    </form>
					<table id="tblProdutos" class="table table-hover mt-2 tabelaProdutos">
						<thead class="thead  text-light" style="background-color: #222">
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
						<tbody class="table-bordered">
							<?php 
							if (count($data['produtos']) > 0) {
						// print_r($data['funcionarios']);
								foreach ($data['produtos'] as $produto) { ?>
									<tr data-codigop="<?= $produto['prdtCodigo'] ?>">
                            
										<input type="hidden" id="<?= $produto['idProduto']."idProduto" ?>" class="form-control" name="idProduto" value="<?=$produto['idProduto']?>">
										<td>
                                            <input type="text" id="<?= $produto['idProduto']."produtoCodigo" ?>" class="form-control form-control-sm" name="produtoCodigo" onblur="fnBuscaCodigo(this)" value="<?= str_replace('-', ' ', $produto['prdtCodigo']) ?>" ondblclick="ativaInput(this.id)" readonly/>
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
                                        <td style="width: 8em;">
                                            <select id="<?= $produto['idProduto']."produtoMarca" ?>" data-marcaid="<?= $produto['idMarca']?>" class="selectMarca custom-select w-100" name="produtoMarca">
                                                <option value="<?= $produto['idMarca'];?>"><?= str_replace('-', ' ',$produto['mrcNome']); ?></option>
                                            </select>
                                        </td>
										<td style="border-collapse: collapse !important; border-bottom: none; border-left: none; border-right: none;" class="d-flex flex-row justify-content-around p-0 pt-3 align-items-center">
											<i onClick="alterarDadosProd('<?= $produto['idProduto']."idProduto" ?>')" class="fas fa-check-square"></i>
											<i onClick="deletarProd('<?= $produto['idProduto']."idProduto" ?>')" class="fas fa-trash-alt"></i></button>
                                            <a href="/mvcaplicado/public/gerente/produto/detalhes/<?= $produto['idProduto']; ?>"><i style="color:#111 !important" class="fas fa-search-plus"></i></a>
										</td>
									</tr>
									<?php } ?>
									<!--<tr style="background-color: #222">
										
									</tr>-->

								<?php } else{
									echo "<tr><td colspan='7'><center>Você ainda não possui produtos cadastrados :( <a style='color: black !important; font-weight: bolder;' href='/mvcaplicado/public/gerente/cadastrarprodutos'>Clique aqui</a> para cadastrar.</center></td></tr>";
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
                    //   selectCat[c].insertAdjacentHTML('beforeend', '<option value="add">Adicionar</option>');               
                
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
                    //   selectMarca[c].insertAdjacentHTML('beforeend', '<option value="add">Adicionar</option>');               
                
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
                if(conexao.responseText == 1) {
		 		    location.reload(true);
                } else {
                    alert('Código já existente!');
                }
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
					if(conexao.responseText == 1){
                        location.reload(true);
				    } else {
                        alert("Erro ao tentar excluir!");
                    } 
			     }
			} else {
				alert("Operação cancelada ;) ");
			}
		}

        function fnBuscaCodigo(element) {
            codigo = element.value;
			var conn = new XMLHttpRequest();
			conn.open('GET', '/mvcaplicado/public/produto/search/'+codigo);
			conn.send();

			conn.onload = () => {
				if(conn.responseText == 0) {
					element.value = '';
					element.placeholder = "Código existente!";
					element.focus();
				}
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
            echo "<script type='text/javascript'>alert('Produto inexistente!');</script>";
         } ?>
</html>