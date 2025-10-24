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

    public function listar()
    {
        try {
            $sql = "SELECT id, tipo, numero, preco, ativo FROM quartos";
            return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erro ao listar quartos: " . $e->getMessage());
        }
    }

    public function buscarPorId($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM quartos WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar quarto: " . $e->getMessage());
        }
    }

    public function updateStatusRoom($id, $ativo)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE quartos SET ativo = ? WHERE id = ?");
            $stmt->execute([$ativo, $id]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function atualizar($id, $numero, $tipo, $preco, $descricao, $ativo)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE quartos SET numero = ?, tipo = ?, preco = ?, descricao = ?, ativo = ? WHERE id = ?");
            $stmt->execute([$numero, $tipo, $preco, $descricao, $ativo, $id]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function excluir($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM quartos WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}