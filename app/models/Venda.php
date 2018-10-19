<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class Venda extends Eloquent
{
	protected $table = 'Venda';
	protected $primaryKey = 'idVenda';
	public $timestamps = false;

	protected $fillable = ['vndData','vndValorTotal', 'vndDesconto', 'vndStatus', 'vndPagamento', 'vndParcelas', 'vndValorParcela', 'idFuncionario', 'idCliente'];

}