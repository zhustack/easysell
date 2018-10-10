<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Funcionario extends Eloquent
{
	protected $table = 'Funcionario';
	protected $primaryKey = 'idFuncionario';
	public $timestamps = false;

	protected $fillable = ['fCodigo','fNome', 'fSobrenome', 'fDataNasc', 'fFoto', 'fEmail', 'fSenha', 'fStatus', 'fELider', 'idTipoFunc'];

}