<?php

class ItemController extends Controller {
    
    private $item;

    public function create($idP,$pQtde,$idV){
        $this->item = Item::create([
            'idProduto' => $idP,
            'idVenda' => $idV,
            'tmStatus' => 'I',
            'tmQuantidade' => $pQtde
        ]);

        echo $this->item->idItem;
    }

    public function updateQuant($pQtde, $idItem) {
        $this->item = Item::find($idItem);
        $this->item->update([
            'tmQuantidade' => $pQtde
        ]);

        // echo $this->item;
    }

}