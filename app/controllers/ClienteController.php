<?php

session_start();

class ClienteController extends Controller {
    private $cliente;

    public function create() {

        $this->cliente = Cliente::create([
            'idFuncionario' => $_SESSION['dados']['idFuncionario']
        ]);
        
        echo json_encode(Cliente::find($this->cliente->idCliente)->get());
    }

    public function index() {
        
    }

    public function lastid() {
        
    }

    public function listAll() {
        $lista = Cliente::whereRaw('idFuncionario = ? and clntTelefone != "(00) 00000-0000"', [$_SESSION['dados']['idFuncionario']])->get();
        echo json_encode($lista);
    }


}
