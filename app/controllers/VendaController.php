<?php

session_start();

class VendaController extends Controller {
    private $vendaAberta;
    private $venda;
    private $funcionario;

    function __construct() {
        $this->funcionario = Funcionario::find($_SESSION['dados']['idFuncionario'])->toArray();
    }

    public function index($params = ''){
        
        if($params == 'sucess') {
            $msg = 1;
        } else {
            $msg = 0;
        }


        if($this->funcionario['idTipoFunc'] == 1) {
            $arrayProdutos = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "a" and Categoria.idFuncionario = ?', [$this->funcionario['idFuncionario']])->get()->toArray();
        } else {
            $idFuncionario = Funcionario::whereRaw('fEmail = ? and fStatus = "A"', [$this->funcionario['fELider']])->get()->toArray();

            $arrayProdutos = Produto::join('Categoria', 'Produto.idCategoria', '=', 'Categoria.idCategoria')->join('Marca','Produto.idMarca','=','Marca.idMarca')->whereRaw('prdtStatus = "a" and Categoria.idFuncionario = ?', [$idFuncionario[0]['idFuncionario']])->get()->toArray();
            
        }
        
        $this->view('venda/index',
                   [
                    'titlePage' => "Caixa",
                    'fNome' => $this->funcionario['fNome'],
                    'imgPerfil' =>$this->funcionario['fFoto'], 
                    'produtos' => $arrayProdutos,
                    'msg' => $msg,
                    'idFuncionario' =>$this->funcionario['idFuncionario']
                   ]
                   
                   );
    }


    public function consultaAberta() {
        
        $this->vendaAberta = Venda::whereRaw('idFuncionario = ? and vndStatus = "R" ', [$this->funcionario['idFuncionario']])->get();
        
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
            'idFuncionario' => $this->funcionario['idFuncionario'],
            'idCliente' => $idCliente,
            'vndData' => date("Y-m-d H:i:s")
        ]);

        echo $this->venda->idVenda;
    }
    public function finalizar() {
        if(isset($_POST['idVenda'])) {
            extract($_POST);

            $this->venda = Venda::find($idVenda);
            $this->venda->update([
                'vndData' => date("Y-m-d H:i:s"),
                'vndValorTotal' => $vndValorTotal,
                'vndDesconto' => $vndDesconto == "" ? 0:$vndDesconto,
                'vndStatus' => 'A',
                'vndPagamento' => $vndParcelas != 1 ? 'P' : 'V',
                'vndParcelas' => $vndParcelas,
                'vndValorParcela' => $vndValorParcela,
                'idCliente' => $idCliente
            ]);
            echo '<pre>';
            $itens = Item::whereRaw('idVenda = ?', [$idVenda])->get()->toArray();
            foreach($itens as $item) {
                $tm = Item::find($item['idItem']);
                $tm->update([
                    'tmStatus' => "A"
                ]);
                $produto = Produto::find($item['idProduto']);
                var_dump($produto['prdtQuantidade']);
                $produto->update([
                    'prdtQuantidade' => $produto['prdtQuantidade'] - $tm['tmQuantidade']
                ]);
            echo '</pre>';
            
            header('location: /mvcaplicado/public/venda/index/sucess');
        }
    }   
    }

    public function fail($id) {
        $vendaFail = Venda::find($id); 
        $cliente = $vendaFail->idCliente;
        $vendaFail->delete();
        Cliente::find($cliente)->delete();
    }
}