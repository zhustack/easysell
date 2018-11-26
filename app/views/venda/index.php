<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>

	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php 
				if($_SESSION['dados']['idTipoFunc'] == 1) {
					require_once "../app/views/common/navLateralG.php"; 			
				} else {
					require_once "../app/views/common/navLateralF.php"; 			
				}
			?>
			<div class="general d-flex justify-content-center align-items-center flex-row h-100 p-0">
					<div class="painelVendas rounded pt-3">
						<div class="painelEsquerdo">
							<span>
								<label class="text-center display-4 rounded-top bg-dark text-light p-1 mb-0 ">Selecione um produto</label>
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
								<input onblur="fazTotal()" class="form-control inputt" id="qtdeItem" type="number" name="qtdProdVenda" min-value="1" min="1" value="1" />
							</div>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text espacamento">
									<i class="fas fa-cart-plus"></i></span>
								</div>
								<input class="form-control inputt" type="text" id="valorTotal" autocomplete="off" name="valorTotal" placeholder="Total" readonly/>
								
								
							</div>
							<button name="addItem" onClick="fnAddItem(parseInt(document.all.prdtCodigo.value))" class="btn btn-defaultOur" value="btn">Adicionar Item</button>
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
						<form action="/mvcaplicado/public/venda/finalizar" method="post">
							<span class="dadosCliente mb-3">
								<label class="display-4 text-center bg-dark text-light rounded p-1 mb-0">Dados do Cliente</label>
								<input type="hidden" name="idVenda" id="idVenda" />
								<input type="hidden" id="idCliente" name="idCliente" />
								<div class="input-group">
									<div class="input-group-append">
										<span class="input-group-text espacamento"><i class="fas fa-user"></i></span>
									</div>
									<input class="form-control inputt" type="text" id="nomeCliente" name="nomeCliente" list="listaClientes" autocomplete="off" required="required" placeholder="Nome Completo" />
									<datalist id="listaClientes">
									</datalist>
								</div>
								<div class="input-group">
									<div class="input-group-append">
										<span class="input-group-text espacamento"><i class="fas fa-mobile-alt"></i></i></span>
									</div>
									<input class="form-control inputt" type="text" id="telCliente" name="telCliente" autocomplete="off" required="required" placeholder="Telefone" />
								</div>
								<div class="input-group">
									<div class="input-group-append">
										<span class="input-group-text espacamento"><i class="fas fa-address-card"></i></span>
									</div>
									<input class="form-control" type="text" id="cpfCliente" name="cpfCliente" autocomplete="off" required="required" placeholder="CPF" />
								</div>
							</span>
							<span>
								<label class="display-4 text-center bg-dark text-light rounded p-1 mb-0">Dados da Venda</label>
								<span class="flex-column align-items-start justify-content-center">

									<!-- <input class="inputt" type="radio" name="pago" value="V" checked ><label class="mr-3">À vista</label>
									<input class="inputt" type="radio" name="pago" value="P"><label class="mr-5">À prazo</label> -->
									
									<div id="divParcelas" class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text espacamento" for="vndParcelas"><i class="fas fa-credit-card"></i></span>
										</div>
										<select class="custom-select" id="vndParcelas" name="vndParcelas">
											<option disabled>Parcelas</option>
											<option selected value="1">1x</option>
											<option value="2">2x</option>
											<option value="3">3x</option>
											<option value="4">3x</option>
											<option value="5">3x</option>
											<option value="6">3x</option>
										</select>
										<input type="text" class ="form-control" name="vndValorParcela" id="vndValorParcela" placeholder="Valor da Parcela" readonly />
									</div>
									
									<div class="input-group w-50">
										<div class="input-group-append">
											<span class="input-group-text espacamento"><i class="fas fa-donate"></i></span>
										</div>
										<input class="form-control inputt" type="text" name="vndDesconto" id="vndDesconto" placeholder="Desconto"/>
									</div>
									<div class="input-group w-50">
										<div class="input-group-append">
											<span class="input-group-text espacamento"><i class="fas fa-cart-plus"></i></span>
										</div>
										<input class="form-control inputt" type="text" id="vndValorTotal" name="vndValorTotal" value="" placeholder="Total" readonly/>
									</div>
							</span>
							<span class="botoesSobreVenda d-flex flex-row">
								<button type="submit" class="btn btn-defaultOur" name="btnFinalizar">Finalizar
								</button>
							</span>
						</form>
								
						<!-- </form> -->
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
		var 
			idCliente, 
			idVenda,
			idProduto, 
			prdtCodigo, 
			prdtNome, 
			prdtValor,
			nItemInicial;

		document.body.onload = fnVerVenda();
		
		function fnVendaFail()
		{
			conn = new XMLHttpRequest();
			conn.open('GET', '/mvcaplicado/public/venda/fail/'+parseInt(document.all.idVenda.value));
			conn.send();
		}

		function fnVerVenda(){
            const venda = new XMLHttpRequest();
            venda.open('GET', '/mvcaplicado/public/venda/consultaAberta/');
            venda.send();
            venda.onload = () => {
                if(venda.responseText == 0)  {
					fnCriarCliente();
				} else {
					idVenda = venda.responseText;
					document.all.idVenda.value = idVenda;

					fnVendaFail();
					fnCriarCliente();
				}
            }
        }

		function fnCriarCliente(){
			const cliente = new XMLHttpRequest();
			cliente.open('GET', '/mvcaplicado/public/cliente/create/');
			cliente.send();
			cliente.onload = () => {
				clienteJ = JSON.parse(cliente.responseText);
				with(document.all) {
					idCliente.value = clienteJ[0].idCliente;
					nomeCliente.value = clienteJ[0].clntNomeCompleto;
					telCliente.value = clienteJ[0].clntTelefone;
					cpfCliente.value = clienteJ[0].clntCpf;
				}
				fnAbrirVenda(clienteJ[0].idCliente);
			}
		}

		function fnListaCliente(listaCliente){
			const conn = new XMLHttpRequest();
			conn.open('GET', '/mvcaplicado/public/cliente/listAll');
			conn.send();
			conn.onload = () => {

				clientes = JSON.parse(conn.responseText);

				for(i=0; i<clientes.length;i++){
					listaCliente.insertAdjacentHTML('beforeend','<option value=" ' + clientes[i].clntNomeCompleto + ' ' + clientes[i].clntTelefone + '" data-nome="'+ clientes[i].clntNomeCompleto +'" data-tel="' + clientes[i].clntTelefone + '" data-cpf="' + clientes[i].clntCpf + '" >');
				}
			}
		}
        
		function fnAbrirVenda(idCliente) {
			const venda = new XMLHttpRequest();
			venda.open('GET', '/mvcaplicado/public/venda/abrir/'+idCliente);
			venda.send();
			venda.onload = () => {
				idVenda = venda.responseText;
				document.all.idVenda.value = idVenda;
			}
		}

        function carregaProduto(codigo) {
			
			var bFind;

			for(i=0;i < document.all.listCodigos.children.length; i++) {
				if( codigo == document.all.listCodigos.children[i].value ) {
					bFind = true;
					break;
				}

				bFind = false;
			}

            if(bFind == true){
				const conexao = new XMLHttpRequest();
				conexao.open('GET', '/mvcaplicado/public/produto/show/' + codigo);
				conexao.send();
				conexao.onload = () => {
					produto = JSON.parse(conexao.responseText);
					idProduto = document.all.idProduto.value = produto[0].idProduto;
					prdtNome = document.all.prdtNome.value = produto[0].prdtNome.replace('-',' ').replace('-',' ');
					prdtValor = document.all.prdtValor.value = produto[0].prdtValor;
					prdtCodigo = parseInt(codigo);

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

		function fnAddItem(nCodigo){

			let tabela = document.all.eTblItem;

			if(fnCountItens(nCodigo) == -1) {
				const conexao = new XMLHttpRequest();
				conexao.open('GET','/mvcaplicado/public/item/create/'+idProduto+'/'+document.all.qtdeItem.value+'/'+idVenda);
				conexao.send();
				conexao.onload = () => {
					// alert(conexao.responseText);
					tabela.insertAdjacentHTML("beforeend", "<tr id='"+conexao.responseText+"'><td class='tdCodigo'>" + prdtCodigo + "</td><td>" + prdtNome + "</td><td onclick='fnGetItem(this)' onblur='fnSoma(nItemInicial,this, this.nextElementSibling)' contentEditable='true'>" + document.all.qtdeItem.value + "</td><td class='subtotal'>" + document.getElementById('valorTotal').value + "</td><td><i onClick='fnDeletaItem()' class='fas fa-trash-alt'></i></td></tr>");
					fnLimpaCampoItem();
					fnValorTotal();
					if(document.all.vndParcelas.value == 1){			
						document.all.vndValorParcela.value = document.all.vndValorTotal.value;
					}
				}
			} else {
				alert('Item já adicionado! \nAltere a quantidade na lista de itens!');
				fnLimpaCampoItem();
			}

		}

		function fnCountItens(nCodigo) {
			let tdCodigo = document.getElementsByClassName('tdCodigo');
			if(tdCodigo.length > 0){
				for (i = 0;i < tdCodigo.length; i++) {
					if(tdCodigo[i].innerText == nCodigo) {
						return 0;
					} 
				}
			} 

			return -1;
		}

		function fnGetItem(nV) {
			nItemInicial = nV.innerText;
			nEInicial = nV;
		}

		function fnSoma(nV, element,  nVtotal) {
			nQtdeItem = element.innerText;
			idItem = element.parentElement.id;
			if(nQtdeItem != 0){
				nUnitario = parseFloat(nVtotal.innerText) / parseFloat(nV);
				nVtotal.innerText = (parseFloat(nUnitario) * parseFloat(nQtdeItem)).toFixed(2);
				fnValorTotal();
				conn = new XMLHttpRequest();
				conn.open('GET', '/mvcaplicado/public/item/updateQuant/'+nQtdeItem+'/'+idItem);
				conn.send();
				if(document.all.vndParcelas.value == 1){			
						document.all.vndValorParcela.value = document.all.vndValorTotal.value;
				}
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
			document.all.valorTotal.value = "";
		}

		function fnValorTotal() {
			let total = 0, subtotais = document.getElementsByClassName('subtotal');

			for(i = 0; i < subtotais.length; i++) {
				total = total + parseFloat(subtotais[i].innerText);
			}

			document.all.vndValorTotal.value = total.toFixed(2);

		}
        
		document.all.vndParcelas.onchange = () => {
			document.all.vndValorParcela.value = (document.all.vndValorTotal.value / document.all.vndParcelas.value).toFixed(2);
		}

		fnListaCliente(document.all.listaClientes);
		
    </script>
</html>