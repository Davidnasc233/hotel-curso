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
}