<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class Cliente extends Eloquent
{
	protected $table = 'Cliente';
	protected $primaryKey = 'idCliente';
	public $timestamps = false;

	protected $fillable = ['clntNomeCompleto','clntCpf', 'clntTelefone', 'idFuncionario'];

}