<?php
namespace app\model;

use app\core\Model;

/**
 * Classe responsável por gerenciar a conexão com a tabela produto
 */
class ProdutoModel {

    // Instância da classe Model
    private $pdo;
    
    /**
     * Método construtor
     *
     * @return void
     */
    public function __construct() {

        $this->pdo = new Model();

    }
    
    /**
     * Insere um novo registro na tabela produto e retorna seu ID em caso de sucesso
     *
     * @param  Object $params Lista com os parâmetros a serem inseridos
     * @return int Retorna o ID do produto inserido ou -1 em caso de erro
     */
    public function insert(Object $params) {

        $sql = 'INSERT INTO produto (nome, imagem, texto) VALUES (:n, :i, :t)';

        $params = [
            ':n' => $params->nome,
            ':i' => $params->imagem,
            ':t' => $params->texto
        ];

        if (!$this->pdo->executeNonQuery($sql, $params))
            return -1;

        return $this->pdo->getLastID();

    }
    
    /**
     * Atualiza um registro na base de dados através do ID do produto
     *
     * @param  Object $params Lista com os parâmetros a serem inseridos
     * @return bool True em caso de sucesso e false em caso de erro
     */
    public function update(Object $params) {

        $sql = 'UPDATE produto SET nome = :n, imagem = :i, texto = :t WHERE id = :id';

        $params = [
            ':id' => $params->id,
            ':n' => $params->nome,
            ':i' => $params->imagem,
            ':t' => $params->texto
        ];

        return $this->pdo->executeNonQuery($sql, $params);

    }
    
    /**
     * Exclui um registro na base de dados através do ID do produto
     *
     * @param  Object $params Lista com os parâmetros a serem inseridos
     * @return bool True em caso de sucesso e false em caso de erro
     */
    public function delete(Object $params) {

        $sql = 'DELETE FROM produto WHERE id = :id';

        $params = [
            ':id' => $params->id
        ];

        return $this->pdo->executeNonQuery($sql, $params);

    }
    
    /**
     * Retorna todos os registros da base de dados em ordem ascendente por nome
     *
     * @return array[object] Retorna um array de objetos
     */
    public function getAll() {

        // Escreve a consulta SQL e atribuímos a variável $sql
        $sql = 'SELECT id, nome, imagem, texto FROM produto ORDER BY nome ASC';

        // Executa a consulta chamando o método da classe Model. Atribui o resultado a variável $dt (data table)
        $dt = $this->pdo->executeQuery($sql);

        // Declara uma lista inicialmente nula
        $listaProduto = null;

        // Percorre todas as linhas do resultado da busca
        foreach ($dt as $dr) { // $dr (data row)

            // Atribui a última posição do array o produto devidamente tratado
            $listaProduto[] = $this->collection($dr);
        
        }

        // Retorna a lista de produtos
        return $listaProduto;
        
    }
        
    /**
     * Retorna um único registro da base de dados através do ID informado
     *
     * @param  mixed $id ID do objeto a ser retornado
     * @return object Retorna um objeto populado com os dados do produto ou com valores nulos se não encontrar
     */
    public function getById(int $id) {
        
        $sql = 'SELECT id, nome, imagem, texto FROM produto WHERE id = :id';

        $params = [
            ':id' => $id
        ];

        $dr = $this->pdo->executeQueryOneRow($sql, $param);

        return $this->collection($dr);

    }
    
    /**
     * Converte uma estrutura de array vinda da base de dados em um objeto devidamente tratado
     *
     * @param  array|object $param Recebe o parâmetro que é retornado na consulta com a base de dados
     * @return object Retorna um objeto devidamente tratado com a estrutura de produto
     */
    private function collection($param) {

        return (object)[
            'id' => $param['id'] ?? null, // O operador ?? (null coalesce)
            'nome' => $param['nome'] ?? null,
            'imagem' => $param['imagem'] ?? null,
            'texto' => $param['texto'] ?? null
        ];

    }

}
