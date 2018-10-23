<?php

class VendaController extends Controller {
    private $vendaAberta;
    private $venda;


    public function consultaAberta($idF) {
        
        $this->vendaAberta = Venda::whereRaw('idFuncionario = ? and vndStatus = "R" ', [$idF])->get();
        
        if($this->vendaAberta->count() > 0) {
            echo $this->vendaAberta->toArray()[0]['idVenda'];
        } else {
            echo false;
        }
        
    }

    public function abrir($idF, $idCliente) {
        $this->venda = Venda::create([
            'vndStatus' => 'R',
            'idFuncionario' => $idF,
            'idCliente' => $idCliente
        ]);

        echo $this->venda->idVenda;
    }
    
}