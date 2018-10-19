<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class Item extends Eloquent
{
	protected $table = 'Item';
	protected $primaryKey = 'idItem';
	public $timestamps = false;

	protected $fillable = ['tmQuantidade','tmStatus', 'idProduto', 'idVenda'];

}