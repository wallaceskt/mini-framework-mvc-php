<?php
namespace app\controller;

use app\core\Controller;
use app\model\ProdutoModel;
use app\classes\Input;

class ProdutoController extends Controller {

    // Instância da classe ProdutoModel
    private $produtoModel;
    
    /**
     * Método construtor
     *
     * @return void
     */
    public function __construct() {

        $this->produtoModel = new ProdutoModel();

    }
    
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

        $produto = $this->getInput();
        
        if (!$this->validate($produto, false)) {
            
            return $this->showMessage('Formulário inválido', 'Os dados fornecidos são inválidos', BASE . 'novo-produto/', 422);
        
        }
        
        $resultado = $this->produtoModel->insert($produto);
        
        if ($resultado <= 0) {
            
            echo "Erro ao cadastrar um novo produto!";
            die();

        }

        redirect(BASE . 'editar-produto/' . $resultado);

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
    
    /**
     * Valida se os campos recebidos são válidos
     *
     * @param  Object $produto
     * @param  bool $validateId
     * @return bool
     */
    public function validate(Object $produto, bool $validateId = true) {

        if ($validateId && $produto <= 0)
            return false;

        if (strlen($produto->nome) < 3)
            return false;

        if (strlen($produto->imagem) < 5)
            return false;

        if (strlen($produto->texto) < 10)
            return false;

        return true;

    }

}
