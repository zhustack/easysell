<?php

session_start();

class VendaController extends Controller {
    private $vendaAberta;
    private $venda;


    public function consultaAberta() {
        
        $this->vendaAberta = Venda::whereRaw('idFuncionario = ? and vndStatus = "R" ', [$_SESSION['dadosGerente']['idFuncionario']])->get();
        
        if($this->vendaAberta->count() > 0) {
            echo $this->vendaAberta->toArray()[0]['idVenda'];
        } else {
            echo 0;
        }
        
    }
    public function abrir($idCliente) {
        date_default_timezone_set('America/Sao_Paulo');
        $this->venda = Venda::create([
            'vndStatus' => 'R',
            'idFuncionario' => $_SESSION['dadosGerente']['idFuncionario'],
            'idCliente' => $idCliente,
            'vndData' => date("Y-m-d H:i:s")
        ]);

        echo $this->venda->idVenda;
    }
    
}