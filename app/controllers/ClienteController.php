<?php

class ClienteController extends Controller {
    private $cliente;

    public function create($idF) {

        $this->cliente = Cliente::create([
            'idFuncionario' => $idF
        ]);
        
        echo $this->cliente->idCliente;
    }

    public function index($idF) {
        
    }

    public function lastid() {
        
    }


}
