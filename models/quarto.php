<?php
class Quarto
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(
        $numero,
        $tipo,
        $preco,
        $descricao,
        $ativo
    ) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO quartos (numero, tipo, preco, descricao, ativo) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$numero, $tipo, $preco, $descricao, $ativo]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listar() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM quartos ORDER BY id ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar quartos: " . $e->getMessage());
        }
    }

    public function buscarPorId($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM quartos WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar quarto: " . $e->getMessage());
        }
    }

    public function atualizar($id, $numero, $tipo, $preco, $descricao, $ativo) {
        try {
            $stmt = $this->pdo->prepare("UPDATE quartos SET numero = ?, tipo = ?, preco = ?, descricao = ?, ativo = ? WHERE id = ?");
            $stmt->execute([$numero, $tipo, $preco, $descricao, $ativo, $id]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function excluir($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM quartos WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}