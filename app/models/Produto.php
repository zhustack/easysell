<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class Produto extends Eloquent
{
	protected $table = 'Produto';
	protected $primaryKey = 'idProduto';
	public $timestamps = false;

	protected $fillable = ['prdtCodigo','prdtNome', 'prdtValor', 'prdtQuantidade', 'prdtStatus', 'prdtDescricao', 'idMarca', 'idCategoria'];

}