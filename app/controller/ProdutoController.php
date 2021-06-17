<?php
namespace app\controller;

use app\core\Controller;
use app\classes\Input;

class ProdutoController extends Controller {
    
    /**
     * Carrega a página principal
     *
     * @return void
     */
    public function index() {

        $this->load('produto/main');

    }
    
    /**
     * Carrega a página com formulário para cadastrar um novo produto
     *
     * @return void
     */
    public function novo() {

        $this->load('produto/novo');

    }
    
    /**
     * Carrega a página com formulário para cadastrar um novo produto
     *
     * @return void
     */
    public function insert() {

        $params = $this->getInput();
        dd($params);

    }
    
    /**
     * Retorna os dados do formulário em uma classe padrão stdObject
     *
     * @return object
     */
    private function getInput() {

        return (object) [
            'id' => Input::get('id', FILTER_SANITIZE_NUMBER_INT),
            'nome' => Input::post('txtNome'),
            'imagem' => Input::post('txtImagem'),
            'texto' => Input::post('txtTexto')
        ];

    }
    
    /**
     * Realiza a busca na base de dados e exibe na página de resultados
     *
     * @return void
     */
    public function pesquisar() {

        $param = Input::get('pes');

        $this->load('produto/pesquisa', [
            'termo' => $param
        ]);

    }

}
