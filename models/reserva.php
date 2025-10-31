<?php
class Reserva
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function inserir($dados)
    {
        $sql = "INSERT INTO reservas (
            quarto_id, nome_cliente, email, cpf, telefone, data_checkin, data_checkout, status, guests, children, created_at
        ) VALUES (
            :quarto_id, :nome_cliente, :email, :cpf, :telefone, :data_checkin, :data_checkout, :status, :guests, :children, :created_at
        )";
        // Validação para ENUM: só aceita 'confirmada' ou 'cancelada'
        $status = isset($dados['status']) && in_array($dados['status'], ['confirmada', 'cancelada'])
            ? $dados['status']
            : 'confirmada';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':quarto_id' => $dados['quarto_id'],
            ':nome_cliente' => $dados['nome_cliente'],
            ':email' => $dados['email'],
            ':cpf' => $dados['cpf'],
            ':telefone' => $dados['telefone'],
            ':data_checkin' => $dados['data_checkin'],
            ':data_checkout' => $dados['data_checkout'],
            ':status' => $dados['status'],
            ':guests' => (int) ($dados['guests'] ?? 1),
            ':children' => (int) ($dados['children'] ?? 0),
            ':created_at' => $dados['created_at'] ?? date('Y-m-d H:i:s')
        ]);
    }

    public function listar()
    {
        $sql = "SELECT r.*, q.numero AS numero_quarto, q.tipo 
                FROM reservas r 
                JOIN quartos q ON r.quarto_id = q.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT r.*, q.numero AS numero_quarto, q.tipo 
                FROM reservas r 
                JOIN quartos q ON r.quarto_id = q.id
                WHERE r.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function atualizar($id, $dados)
    {
        $sql = "UPDATE reservas SET
            quarto_id = :quarto_id,
            email = :email,
            telefone = :telefone,
            data_checkin = :data_checkin,
            data_checkout = :data_checkout,
            status = :status,
            guests = :guests,
            children = :children
            WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':quarto_id' => $dados['quarto_id'],
                ':email' => $dados['email'],
                ':telefone' => $dados['telefone'],
                ':data_checkin' => $dados['data_checkin'],
                ':data_checkout' => $dados['data_checkout'],
                ':status' => $dados['status'],
                ':guests' => (int) ($dados['guests'] ?? 1),
                ':children' => (int) ($dados['children'] ?? 0),
                ':id' => $id
            ]);
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function existeConflito($quarto_id, $data_checkin, $data_checkout, $id_ignorar = null)
    {
        $sql = "SELECT COUNT(*) FROM reservas WHERE quarto_id = :quarto_id
            AND (data_checkin < :data_checkout AND data_checkout > :data_checkin)";
        $params = [
            ':quarto_id' => $quarto_id,
            ':data_checkin' => $data_checkin,
            ':data_checkout' => $data_checkout
        ];
        if (!is_null($id_ignorar)) {
            $sql .= " AND id != :id_ignorar";
            $params[':id_ignorar'] = $id_ignorar;
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    public function remover($id)
    {
        try {
            $sql = "DELETE FROM reservas WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}