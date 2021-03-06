<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>

	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-row">
				<?php require_once "../app/views/common/navLateralG.php"; ?>
				<div class="general h-100 d-flex flex-column justify-content-start align-items-center">
					<form class="w-50" id="cadProd" name="cadProd" method="post" action="/mvcaplicado/public/produto/create/">

						<center><label class="display-4 bg-dark text-light rounded p-1 mt-5 mb-3 w-100">Cadastrar</label></center>

						<div class="input-group input-group-lg mb-2">
							<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-barcode"></i></div>
							</div>
							<input type="text" class="form-control" id="codeProd" name="codeProd" onblur="fnBuscaCodigo(this.value)" placeholder="Código do Produto*" required>
						</div>

						<div class="input-group input-group-lg mb-2">
							<div class="input-group-prepend">
							<div class="input-group-text "><i class="fas fa-tags"></i></div>
							</div>
							<input type="text" class="form-control" id="prodName" name="prodName" placeholder="Nome do Produto*" required>
						</div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                    </div>
                                    <input class="form-control" type="text" id="valor" name="valorUni" placeholder="Valor Un.*" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-shopping-bag"></i></div>
                                    </div>
                                    <input class="form-control" type="number" name="quantidade" id="quantidade" placeholder="Quantidade*" required>
                                </div>
                            </div>
                        </div>

						<div class="form-row mb-2">
							<div class="form-group mb-0 col-md-6">
								<select class="custom-select custom-select-lg" name="prodCat" id="prodCat" required>
									
								</select>
							</div>
							<div class="form-group mb-0 col-md-6">
								<select class="custom-select custom-select-lg" name="prodMarc" id="prodMarc" required>
									
								</select>
							</div>
						</div>
                        <div class="form-group">
                            <textarea class="form-control" id="descricao" name="descricao" rows="5" placeholder="Dê uma breve descrição sobre o produto"></textarea>
                        </div>
                        <button type="button" id="btnEnvia" onclick="fnValida()" class="btn btn-primary">Cadastrar</button>
					</form>

				</div>
		</div>
	</body>
		<script type="text/javascript">
		function fnValida() {
			if(document.all.prodMarc.value == 0 || document.all.prodCat.value == 0) {
				alert('Certifique-se de selecionar a marca e a categoria do seu produto!');
				document.all.prodMarc.style.border="1.5px solid red";
				document.all.prodCat.style.border="1.5px solid red";
				document.all.btnEnvia.type="button";
			} else {
				document.all.btnEnvia.type="submit";
				document.all.btnEnvia.click();
			}
		}

		function carregarMarcas(){
            
			let selectMarca = document.getElementById("prodMarc");

			var conexao = new XMLHttpRequest();
			conexao.open('GET', '/mvcaplicado/public/marca/listAll');
			conexao.send();
			conexao.onload = () => {

				marcas = JSON.parse(conexao.responseText);
                
                selectMarca.insertAdjacentHTML('beforeend', '<option value="0" selected="selected" disabled="disabled">Marca</option>');
                
				for(i=0;i<marcas.length;i++){
					selectMarca.insertAdjacentHTML('beforeend','<option value='+marcas[i].idMarca+'>'+marcas[i].mrcNome.replace('-',' ')+'</option>');
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

				marcaNome = prompt('Digite o nome da marca:');
				if(marcaNome != null && marcaNome != '') {

					conn = new XMLHttpRequest();
					conn.open('GET', '/mvcaplicado/public/marca/criar/'+marcaNome.replace(' ', '-'));
					conn.send();
					conn.onload = () => {
						if(conn.responseText == 1){
							carregarMarcas();
							setTimeout(function () {alert("Marca adicionada com sucesso!");}, 250);
						} else {
							carregarMarcas();
							alert('Marca já cadastrada!');
						}
					}
				} else {
					carregarMarcas();
				}
			};
		}
        
        function carregarCategorias(){
            
			let selectCat = document.getElementById("prodCat");

			var conexao = new XMLHttpRequest();
			conexao.open('GET', '/mvcaplicado/public/categoria/listAll');
			conexao.send();
			conexao.onload = () => {

				categorias = JSON.parse(conexao.responseText);
                
                selectCat.insertAdjacentHTML('beforeend', '<option value="0" selected="selected" disabled="disabled">Categoria</option>');
                
				for(i=0;i<categorias.length;i++){
					selectCat.insertAdjacentHTML('beforeend','<option value='+categorias[i].idCategoria+'>'+categorias[i].ctgrNome.replace('-',' ')+'</option>');
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
				
				catNome = prompt('Digite o nome da categoria:');

				if(catNome != null && catNome != '') {
					conn = new XMLHttpRequest();
					conn.open('GET', '/mvcaplicado/public/categoria/criar/'+catNome.replace(' ', '-'));
					conn.send();
					conn.onload = () => {
						if(conn.responseText == 1) {
							carregarCategorias();
							setTimeout(function () {alert("Categoria adicionada com sucesso!");}, 250);
						} else {
							carregarCategorias();
							alert('Categoria já cadastrada!');
						}
					}
				} else {
					carregarCategorias();
				}
				
				

			};
		}
        
		carregarMarcas();
        carregarCategorias();

		function fnBuscaCodigo(codigo) {
			var conn = new XMLHttpRequest();
			conn.open('GET', '/mvcaplicado/public/produto/search/'+codigo);
			conn.send();

			conn.onload = () => {
				if(conn.responseText == 0) {
					document.all.codeProd.value = '';
					document.all.codeProd.placeholder = "Código existente!";
					document.all.codeProd.focus();
				}
			}
		}

	</script>
	<?php
		 if($data['prdtSucess'] == 1) {
			echo "<script type='text/javascript'>alert('Cadastro Realizado!');</script>"; 
		} else if($data['prdtSucess'] == 0) {
			echo "<script type='text/javascript'>alert('Produto já cadastrado!');</script>";
		} 
	?>
</html>