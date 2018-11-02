<?php

session_start();

class ClienteController extends Controller {
    private $cliente;

    public function create() {

        $this->cliente = Cliente::create([
            'idFuncionario' => $_SESSION['dadosGerente']['idFuncionario']
        ]);
        
        echo json_encode(Cliente::find($this->cliente->idCliente)->get());
    }

    public function index() {
        
    }

    public function lastid() {
        
    }


}
