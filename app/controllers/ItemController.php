<?php

class ItemController extends Controller {
    
    public function create($idP,$pQtde,$idV){
        Item::create([
            'idProduto' => $idP,
            'idVenda' => $idV,
            'tmStatus' => 'A',
            'tmQuantidade' => $pQtde
        ]);
    }

}