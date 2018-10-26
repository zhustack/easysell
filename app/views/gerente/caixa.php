<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>

	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php require_once "../app/views/common/navLateralG.php"; ?>
			<div class="general d-flex justify-content-center align-items-center flex-row h-100 p-0">
					<div class="painelVendas rounded pt-3">
						<div class="painelEsquerdo">
							<span>
								<label class="text-center display-4 rounded-top bg-dark text-light p-1 mb-0 ">Selecione um produto</label>
								<!--<select name="selectProdVenda" id="selectProdVenda" onchange ="selecionaProdutos()" class="form-control">
									<option value="" selected disabled>Selecionar</option>
									<?php /*
										$listaProdutos = listaProd("");
										foreach ($listaProdutos as $produtos) {
									?>
									<option value="<?php echo $produtos['idProduto'];?>">
										<?php echo $produtos['codProd']; ?>&nbsp &nbsp &nbsp <?php echo $produtos['nome'];?> 		
									</option>
									<?php
										} */
									?>
								</select> -->
							</span>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text espacamento">
									<i class="fas fa-barcode"></i></span>
								</div>
								<input onblur="carregaProduto(this.value)" class="form-control" list="listCodigos" type="text" name="prdtCodigo" id="prdtCodigo" placeholder="Insira o código do produto" autocomplete="off"/>
                                
                                <datalist id="listCodigos">
                                    <?php foreach($data['produtos'] as $produto){ ?>
                                        <option value="<?= $produto['prdtCodigo']; ?>">
                                    <?php } ?>
                                </datalist>
							</div>
							<input class="inputt" type="hidden" name="idProduto">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text espacamento">
								<i class="fas fa-tags"></i></span>
								</div>
								<input class="form-control inputt" type="text" id="prdtNome" name="prdtNome" autocomplete="off" placeholder="Nome" readonly/>
							</div>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text espacamento">
									<i class="fas fa-dollar-sign"></i></span>
								</div>
								<input class="form-control inputt" id="prdtValor" type="text" autocomplete="off" name="prdtValor" placeholder="Valor Unitário" readonly/>
							</div>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text espacamento">
									<i class="fas fa-shopping-bag"></i></span>
								</div>
								<input onblur="fazTotal()" class="form-control inputt" id="qtdeItem" type="number" name="qtdProdVenda" value="1" />
							</div>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text espacamento">
									<i class="fas fa-cart-plus"></i></span>
								</div>
								<input class="form-control inputt" type="text" id="valorTotal" autocomplete="off" name="valorTotal" placeholder="Total" readonly/>
								
								
							</div>
							<button name="addItem" onClick="fnAddItem()" class="btn btn-defaultOur" value="btn">Adicionar Item</button>
						<?php
						/*
						if (pegaUltimoID() <=0) {
							conectar();
							query("insert into Venda(idVendedor,status) values('{$_SESSION['idVendedor']}','re')");
							$idUVenda = pegaUltimoID();
						}else{
							$idUVenda = pegaUltimoID();
						}	
							if(isset($_POST['addItem'])){
								conectar();
								query("insert into Item values(0,".$_POST['qtdProdVenda'].",".$_POST['valorTotal'].",'re',".$_POST['idProduto'].",".$idUVenda.",".$_SESSION['idVendedor'].")");
								desconectar();
							}
                            */
						?>
							<span class="itensAdicionadosDesc mt-3">
								<label class="display-4 text-center bg-dark text-light p-1 mb-0">Itens</label>
								<table class=" tabelinha w-100 table table-hover rounded table-bordered table-light" id="eTblItem">
									<tr>
										<th scope="col">Cód.</th>
										<th scope="col">Nome</th>
										<th scope="col">Qtd.</th>
										<th scope="col">Subtotal</th>
										<th scope="col">X</th>
									</tr>
									<?php
                                        /*
										if(isset($_POST['addItem'])){
										conectar();
										query("select * from Item inner join produto on Item.idProduto = Produto.idProduto where idVendedor = ".$_SESSION['idVendedor']." and item.status = 're'");
									}
										$arrayItem = arrayBD();
										foreach ($arrayItem as $item) {
									?>
									<tr class="topo">
										<td><?php echo $item['codProd'];?></td>
										<td><?php echo $item['nome'];?></td>
										<td><?php echo $item['qtde'];?></td>
										<td>R$&nbsp<?php echo $item['subtotal'];?></td>
										<td><button onclick="cancelaItem(this.value)" value="<?php echo $item['idItem']?>">X</button></td>
									</tr>
									<?php 
										}
										desconectar();
                                        */
									?>
								</table>
								</span>
						
					</div>
					<div class="painelDireito">
						<form action="" method = "post">
							<span class="dadosCliente mb-3">
								<label class="display-4 text-center bg-dark text-light rounded p-1 mb-0">Dados do Cliente</label>
								<div class="input-group">
									<div class="input-group-append">
										<span class="input-group-text espacamento"><i class="fas fa-user"></i></span>
									</div>
									<input class="form-control inputt" type="text" name="nomeCliente" autocomplete="off" required="required" placeholder="Nome do Cliente" />
								</div>
								<div class="input-group">
									<div class="input-group-append">
										<span class="input-group-text espacamento"><i class="fas fa-mobile-alt"></i></i></span>
									</div>
									<input class="form-control inputt" type="text" name="telCliente" autocomplete="off" required="required" placeholder="Telefone do Cliente" />
								</div>
							</span>
							<span>
								<label class="display-4 text-center bg-dark text-light rounded p-1 mb-0">Dados da Venda</label>
								<span class="flex-row align-items-center justify-content-center bg-white">
									<input class="inputt" type="radio" name="pago" value="s" checked ><label class="mr-3">À vista</label>
									<input class="inputt" type="radio" name="pago" value="n"><label class="mr-5">À prazo</label>
								</span>
								<span id="alinhamento" >
									<div class="input-group w-100">
										<div class="input-group-append">
											<span class="input-group-text espacamento"><i class="fas fa-calendar-alt"></i></span>
										</div>
									<input class="inputt form-control rounded" type="date" name="dataVenda">
									</div>
								<?php
									/*conectar();
									query("select sum(subTotal) from item where idVendedor = {$_SESSION['idVendedor']} and status = 're'");
									$total = arrayBD();*/

								?>
									<div class="input-group w-100">
										<div class="input-group-append">
											<span class="input-group-text espacamento"><i class="fas fa-cart-plus"></i></span>
										</div>
										<input class="form-control inputt" type="text" name="valorTotal" value="" placeholder="Total"/>
									</div>
								</span>
							</span>
							<span class="botoesSobreVenda d-flex flex-row">
								<button type="submit" onload="location.reload(true)" class="btn btn-defaultOur" name="btnFinalizar">Finalizar
								</button>
							</span>
							
								
						</form>
						<?php
							/*if(isset($_POST['btnFinalizar'])) {
								if(existeCliente($_POST['telCliente']) <=0) {
									cadastraCliente($_POST['nomeCliente'],$_POST['telCliente']);
									$idCliente = existeCliente($_POST['telCliente']);
								}else{
									$idCliente = existeCliente($_POST['telCliente']);
								}
								$valorTotalF = floatval($_POST['valorTotal']);
								conectar();
								query("update Venda set dataVenda = '".$_POST['dataVenda']."', valorTotal = '".$valorTotalF."'  , pago = '".$_POST['pago']."', idCliente = ".$idCliente." where idVendedor = ".$_SESSION['idVendedor']." and status = 're'");
								query("update Produto inner join Item on Produto.idProduto = Item.idProduto set Produto.quantidade = Produto.quantidade - Item.qtde where Item.status = 're' and Item.idVendedor = ".$_SESSION['idVendedor']);
								query("update Item inner join Venda on Item.idVenda = Venda.idVenda set Item.status = 'ef' where Venda.status = 're' and Item.idVendedor = ".$_SESSION['idVendedor']);
								query("update Cliente inner join Venda on Cliente.idCliente = Venda.idCliente set Cliente.valor_divida = Venda.valorTotal where Venda.status = 're' and Venda.pago = 'n' and Venda.idVendedor = ".$_SESSION['idVendedor']);
								query("update Venda set status = 'ef' where idVendedor = ".$_SESSION['idVendedor']." and idVenda = ".$idUVenda);	
							}*/
						?>
					</div>
					</div>
            </div>
        </div>
    </body>
    <script>
		var idCliente;
		var idVenda;

		document.body.onload = fnVerVenda();
		
		function fnVerVenda(){
            const venda = new XMLHttpRequest();
            venda.open('GET', '/mvcaplicado/public/venda/consultaAberta/'+<?= $data['idFuncionario'] ?>);
            venda.send();
            venda.onload = () => {
                if(venda.responseText == false)  {
					fnCriarCliente();
				} else {
					idVenda = venda.responseText;
				}
            }
        }

		function fnCriarCliente(){
			const cliente = new XMLHttpRequest();
			cliente.open('GET', '/mvcaplicado/public/cliente/create/<?= $data["idFuncionario"] ?>');
			cliente.send();
			cliente.onload = () => {
				idCliente = cliente.responseText;
				fnAbrirVenda(idCliente);
			}
		}
        
		function fnAbrirVenda(idCliente) {
			const venda = new XMLHttpRequest();
			venda.open('GET', '/mvcaplicado/public/venda/abrir/'+<?= $data ['idFuncionario'] ?>+'/'+idCliente);
			venda.send();
			venda.onload = () => {
				idVenda = venda.responseText;
				// console.log(idVenda);
			}
		}
		var idProduto, prdtCodigo, prdtNome, prdtValor;

        function carregaProduto(codigo) {
			var bFind;

			for(i=0;i < document.all.listCodigos.children.length; i++) {
				if( codigo == document.all.listCodigos.children[i].value ) {
					bFind = true;
				} else {
					bFind = false;
				}
			}

            if(bFind == true){
				const conexao = new XMLHttpRequest();
				conexao.open('GET', '/mvcaplicado/public/produto/show/<?= $data['idFuncionario'] ?>/' + codigo);
				conexao.send();
				conexao.onload = () => {
					produto = JSON.parse(conexao.responseText);
					idProduto = document.all.idProduto.value = produto[0].idProduto;
					prdtNome = document.all.prdtNome.value = produto[0].prdtNome.replace('-',' ').replace('-',' ');
					prdtValor = document.all.prdtValor.value = produto[0].prdtValor;
					prdtCodigo = codigo;

					document.all.qtdeItem.focus();
				}
			} else {
				// alert('Produto não encontrado!');
				document.all.prdtCodigo.value = '';
				document.all.prdtCodigo.focus();
				document.all.prdtCodigo.placeholder = 'Produto não encontrado!';
				
			}
        }
        
        function fazTotal(){
            document.getElementById('valorTotal').value = (document.getElementById('prdtValor').value * document.getElementById('qtdeItem').value).toFixed(2);
        }

		function fnAddItem(){

			let tabela = document.all.eTblItem;

			if(fnCountItens(prdtCodigo)) {
				tabela.insertAdjacentHTML("beforeend", "<tr id='"+Math.random()+"'><td class='tdCodigo'>" + prdtCodigo + "</td><td>" + prdtNome + "</td><td onclick='fnGetItem(this)' onblur='fnSoma(nItemInicial,this.innerText, this.nextElementSibling)' contentEditable='true'>" + document.all.qtdeItem.value + "</td><td>" + document.getElementById('valorTotal').value + "</td></tr>");
				const conexao = new XMLHttpRequest();
				conexao.open('GET','/mvcaplicado/public/item/create/'+idProduto+'/'+document.all.qtdeItem.value+'/'+idVenda);
				conexao.send();
				fnLimpaCampoItem();
			} else {
				alert('Item já adicionado! \nAltera a quantidade na lista de itens!');
				fnLimpaCampoItem();
			}

		}

		function fnCountItens(nCodigo) {
			let tdCodigo = document.getElementsByClassName('tdCodigo');
			if(tdCodigo.length > 0){
				for (i = 0;i < tdCodigo.length; i++) {
					if(nCodigo == tdCodigo[i].innerText) {
						return i;
					}

					return true;
				}
			} 

			return true;
		}
		
		var nItemInicial;

		function fnGetItem(nV) {
			nItemInicial = nV.innerText;
			nEInicial = nV;
		}

		function fnSoma(nV, nQtdeItem,  nVtotal) {
			if(nQtdeItem != 0){
				nUnitario = parseFloat(nVtotal.innerText) / parseFloat(nV);
				nVtotal.innerText = (parseFloat(nUnitario) * parseFloat(nQtdeItem)).toFixed(2);
			} else {
				// alert('Insira um valor válido!');
				nEInicial.focus();	
			}
		}

		function fnLimpaCampoItem() {
			document.all.idProduto.value = "";
			document.all.prdtNome.value = "";
			document.all.prdtValor.value = "";
			document.all.prdtCodigo.value = "";
			document.all.valorTotal[0].value = "";
		}
        
    </script>
</html>