<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Categoria extends Eloquent
{
	protected $table = 'Categoria';
	protected $primaryKey = 'idCategoria';
	public $timestamps = false;

	protected $fillable = ['ctgrNome', 'idFuncionario', 'ctgrStatus'];

}