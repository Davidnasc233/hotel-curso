<?php
class Reserva {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criar($checkin, $checkout, $room, $guests, $children) {
        $stmt = $this->pdo->prepare("INSERT INTO reservas (checkin, checkout, room, guests, children)
            VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$checkin, $checkout, $room, $guests, $children]);
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM reservas ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

