<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>
	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-row">
				<?php require_once "../app/views/common/navLateralG.php"; ?>
				<div class="general h-100 d-flex flex-column justify-content-start align-items-center">
					<form class="w-50 detalhesProduto" method="post" action="/mvcaplicado/public/produto/editar">

						<center><label class="display-4 bg-dark text-light rounded p-1 mt-5 mb-3">Detalhes</label><center></center>
						<input type="hidden" name="idProduto" id="idProduto" value="<?= $data['produto']['0']['idProduto']?>">
						<div class="input-group input-group-lg mb-2">
							<div class="input-group-prepend">
							<div class="input-group-text">#</div>
							</div>
							<input onDblClick="ativaInput(this.id)" type="text" class="form-control" id="codeProd" name="codeProd" placeholder="Código do Produto" value="<?= $data['produto'][0]['prdtCodigo']; ?>" readonly required>
						</div>

						<div class="input-group input-group-lg mb-2">
							<div class="input-group-prepend">
							<div class="input-group-text">#</div>
							</div>
							<input onDblClick="ativaInput(this.id)" type="text" class="form-control" id="prodName" name="prodName" placeholder="Nome do Produto*" value="<?= str_replace('-',' ', $data['produto']['0']['prdtNome']);?>" readonly required>
						</div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R$</div>
                                    </div>
                                    <input onDblClick="ativaInput(this.id)" class="form-control" type="text" id="valor" name="valorUni" placeholder="Valor Un.*" value="<?= $data['produto']['0']['prdtValor']?>" readonly required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">#</div>
                                    </div>
                                    <input onDblClick="ativaInput(this.id)" class="form-control" type="number" name="quantidade" id="quantidade" placeholder="Quantidade*" value="<?= $data['produto']['0']['prdtQuantidade']?>" readonly required>
                                </div>
                            </div>
                        </div>

						<div class="form-row mb-2">
							<div class="form-group mb-0 col-md-6">
								<select class="custom-select custom-select-lg" name="prodCat" id="prodCat"  required>
                                    
								</select>
							</div>
							<div class="form-group mb-0 col-md-6">
								<select class="custom-select custom-select-lg" name="prodMarc" id="prodMarc" required>
									
								</select>
							</div>
						</div>
                        <div class="form-group">
                            <textarea onDblClick="ativaInput(this.id)" class="form-control" id="descricao" name="descricao" rows="5" placeholder="Dê uma breve descrição sobre o produto" readonly><?= $data['produto'][0]['prdtDescricao']; ?></textarea>
                        </div>
                       <a href="/mvcaplicado/public/gerente/produto"><button type="button" class="btn btn-primary">Voltar</button></a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-primary" onClick="excluirProduto(document.all.idProduto.value)">Excluir</button>
					</form>

				</div>
		</div>
	</body>
    <?php if($data['msg']) {
        echo '<script type="text/javascript">alert("Alteração Sucedida!"); </script>';
} ?>
		<script type="text/javascript">
		function carregarMarcas(){
            
			let selectMarca = document.getElementById("prodMarc");

			var conexao = new XMLHttpRequest();
			conexao.open('GET', '/mvcaplicado/public/marca/listAll/<?=$data["idFuncionario"] ?>');
			conexao.send();
			conexao.onload = () => {

				marcas = JSON.parse(conexao.responseText);
                
                selectMarca.insertAdjacentHTML('beforeend', '<option selected="selected" disabled="disabled">Marca</option>');
                
				for(i=0;i<marcas.length;i++){
                    if(marcas[i].idMarca == "<?= $data['produto'][0]['idMarca'];?>"){
					   selectMarca.insertAdjacentHTML('beforeend','<option selected="selected" value='+marcas[i].idMarca+'>'+marcas[i].mrcNome.replace('-',' ')+'</option>');
                    } else {
                        selectMarca.insertAdjacentHTML('beforeend','<option value='+marcas[i].idMarca+'>'+marcas[i].mrcNome.replace('-',' ')+'</option>');
                    }
				}

				selectMarca.insertAdjacentHTML('beforeend', '<option value="add">Adicionar</option>');
                
			}
		}

		document.getElementById('prodMarc').onchange = () => {
			if(document.getElementById('prodMarc').value == 'add') {
				let selectMarca = document.getElementById("prodMarc");
                let inicial = selectMarca.childElementCount;
                for (i = 0; i < inicial; i++) {
					selectMarca.options.remove(selectMarca.lastChild);
				}
				marcaNome = prompt('Digite o nome da marca:').replace(' ', '-');
				dados = {
					"idFuncionario":"<?= $data['idFuncionario'] ?>",
					"mrcNome":""+marcaNome+""
				};
				dadosJSON = JSON.stringify(dados);

				conn = new XMLHttpRequest();
				conn.open('GET', '/mvcaplicado/public/marca/criar/'+dadosJSON);
				conn.send();
				conn.onload = () => {
                    carregarMarcas();
                    setTimeout(function () {alert("Marca adicionada com sucesso!");}, 250);
				}
			} 
		}
        
        function carregarCategorias(){
            
			let selectCat = document.getElementById("prodCat");

			var conexao = new XMLHttpRequest();
			conexao.open('GET', '/mvcaplicado/public/categoria/listAll/<?=$data["idFuncionario"] ?>');
			conexao.send();
			conexao.onload = () => {

				categorias = JSON.parse(conexao.responseText);
                
                selectCat.insertAdjacentHTML('beforeend', '<option selected="selected" disabled="disabled">Categoria</option>');
                
				for(i=0;i<categorias.length;i++){
					if(categorias[i].idCategoria == '<?= $data['produto'][0]['idCategoria']; ?>'){
                        selectCat.insertAdjacentHTML('beforeend','<option selected="selected" value='+categorias[i].idCategoria+'>'+categorias[i].ctgrNome.replace('-',' ')+'</option>');
                    } else {
                        selectCat.insertAdjacentHTML('beforeend','<option value='+categorias[i].idCategoria+'>'+categorias[i].ctgrNome.replace('-',' ')+'</option>');
                    }
				}

				selectCat.insertAdjacentHTML('beforeend', '<option value="add">Adicionar</option>');
                
			}
		}
            
        document.getElementById('prodCat').onchange = () => {
			if(document.getElementById('prodCat').value == 'add') {
				let selectCat = document.getElementById("prodCat");
                let inicial = selectCat.childElementCount;
                for (i = 0; i < inicial; i++) {
					selectCat.options.remove(selectCat.lastChild);
				}
				catNome = prompt('Digite o nome da categoria:').replace(' ', '-');
				dados = {
					"idFuncionario":"<?= $data['idFuncionario'] ?>",
					"ctgrNome":""+catNome+""
				};
				dadosJSON = JSON.stringify(dados);

				conn = new XMLHttpRequest();
				conn.open('GET', '/mvcaplicado/public/categoria/criar/'+dadosJSON);
				conn.send();
				conn.onload = () => {
                    carregarCategorias();
                    setTimeout(function () {alert("Categoria adicionada com sucesso!");}, 250);
				}
			};
		}
		carregarMarcas();
        carregarCategorias();
            
	</script>
</html>