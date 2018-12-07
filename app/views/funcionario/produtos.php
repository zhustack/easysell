<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>
    
	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-ow">
			<?php require_once "../app/views/common/navLateralF.php"; ?>
			<div class="general d-flex justify-content-start align-items-center flex-column h-100 p-0">
					<label style="font-size: 250%;" class="display-4 text-white bg-dark rounded p-1 mt-5 w-75 mb-0"><center>Produtos</center></label>
                    <form id="searchForm" class="d-flex pl-5 w-100 align-items-start" method="get" action="/mvcaplicado/public/funcionario/produto">
                    <div style="width:32%" class="input-group ml-1 mt-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                            <input id="searchprod" name="searchprod" list="listCodigos" type="text" class="form-control" placeholder="Código do Produto" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text btn-defaultOur"><a style="	text-decoration: none;
	color: #fff;" href="/mvcaplicado/public/funcionario/produto">Listar Todos</a></span>
                            </div>
                        <datalist id="listCodigos">
                            <?php foreach($data['produtos'] as $produto){ ?>
                                <option value="<?= $produto['prdtCodigo']; ?>">
                            <?php } ?>
                        </datalist>
                        
                    </div>
                    </form>
					<table id="tblProdutos" class="table table-hover mt-2 tabelaProdutos">
						<thead class="thead text-light" style="background-color: #222">
							<tr>
								<th scope="col">Código</th>
								<th scope="col">Nome</th>
								<th scope="col">Valor</th>
								<th scope="col">Qtd.</th>
								<th scope="col">Categoria</th>
								<th scope="col">Marca</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody class="table-bordered table-horver">
							<?php 
							if (count($data['produtos']) > 0) {
								foreach ($data['produtos'] as $produto) { ?>
									<tr data-codigop="<?= $produto['prdtCodigo'] ?>">
                            
										<input type="hidden" id="<?= $produto['idProduto']."idProduto" ?>" class="form-control" name="idProduto" value="<?=$produto['idProduto']?>">
										<td class="tdTblProdutos">
                                            <?= str_replace('-', ' ', $produto['prdtCodigo']) ?>
                                        </td>
                                        <td class="tdTblProdutos">
                                            <?= str_replace('-', ' ', $produto['prdtNome']) ?>
                                        </td>
                                        <td class="tdTblProdutos">
                                           R$ <?= str_replace('-', ' ', $produto['prdtValor']) ?>
                                        </td>
                                        <td class="tdTblProdutos">
                                            <?= str_replace('-', ' ', $produto['prdtQuantidade']) ?>
                                        </td>
                                        <td class="tdTblProdutos">                                        
                                            <?= str_replace('-',' ',$produto['ctgrNome']); ?>
                                        </td>
                                        <td class="tdTblProdutos">
                                            <?= str_replace('-', ' ',$produto['mrcNome']); ?>
                                        </td>
										<td class="d-flex flex-row justify-content-between tdTblProdutos">
                                            <a href="/mvcaplicado/public/funcionario/produto/detalhes/<?= $produto['idProduto']; ?>">Detalhes <i class="fas fa-search-plus"></i></a>
										</td>
									</tr>
									<?php } ?>
									<!--<tr style="background-color: #222">
										
									</tr>-->

								<?php } else{
									echo "<tr><td colspan='7'><center><b>Seu gerente ainda não possui produtos cadastrados :( </b></center></td></tr>";
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
        
    </script>
        <?php /*if($data['msg'] == 1) {
            echo "<script type='text/javascript'>alert('Produto inexistente!');</script>";
         }  */?>
</html>