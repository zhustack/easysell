<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Marca extends Eloquent
{
	protected $table = 'Marca';
	protected $primaryKey = 'idMarca';
	public $timestamps = false;

	protected $fillable = ['mrcNome', 'idFuncionario', 'mrcStatus'];

}