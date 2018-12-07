<!DOCTYPE html>
<html lang="pt-br">
	<?php require_once "../app/views/common/head.php"; ?>
	<body>
		<div class="container-fluid p-0 m-0 h-100 w-100 d-flex flex-row">
				<?php require_once "../app/views/common/navLateralF.php"; ?>
				<div class="general h-100 d-flex flex-column justify-content-start align-items-center">
					<!-- <form class="w-50 detalhesProduto" method="post" action="/mvcaplicado/public/produto/editar"> -->
                    <div class="w-50 detalhesProduto">
						<center><label class="display-4 bg-dark text-light rounded p-1 mt-5 w-100 mb-3">Detalhes</label></center>
						<input type="hidden" name="idProduto" id="idProduto" value="<?= $data['produto']['0']['idProduto']?>">
						<div class="input-group input-group-lg mb-2">
							<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-barcode"></i></div>
							</div>
							<input type="text" class="form-control" value="<?= $data['produto'][0]['prdtCodigo']; ?>" readonly>
						</div>

						<div class="input-group input-group-lg mb-2">
							<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-tags"></i></div>
							</div>
							<input type="text" class="form-control" value="<?= str_replace('-',' ', $data['produto']['0']['prdtNome']);?>" readonly>
						</div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-dollar-sign"></i></div>
                                    </div>
                                    <input class="form-control" type="text" value="<?= $data['produto']['0']['prdtValor']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-shopping-bag"></i></div>
                                    </div>
                                    <input class="form-control" type="number"  value="<?= $data['produto']['0']['prdtQuantidade']?>" readonly>
                                </div>
                            </div>
                        </div>

						<div class="form-row mb-2">
							<div class="form-group mb-0 col-md-6">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-tag"></i></div>
                                    </div>
                                    <input class="form-control" type="text" value="<?= $data['produto']['0']['ctgrNome']?>" readonly>
                                </div>
							</div>
							<div class="form-group mb-0 col-md-6">
                            <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-tag"></i></div>
                                    </div>
                                    <input class="form-control" type="text" value="<?= $data['produto']['0']['mrcNome']?>" readonly>
                                </div>
							</div>
						</div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="Descrição não fornecida!" readonly><?= $data['produto'][0]['prdtDescricao']; ?></textarea>
                        </div>
                       <a href="/mvcaplicado/public/funcionario/produto"><button type="button" class="btn btn-primary">Voltar</button></a>
                    </div>

				</div>
		</div>
	</body>
</html>