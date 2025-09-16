const express = require("express");
const db = require("./db");
const cors = require("cors");

const app = express();
const PORT = 3000;

app.use(cors());

app.use(express.json());

//criar a tabela se não existir
(async () => {
  const tableExists = await db.schema.hasTable("reservations");
  if (!tableExists) {
    await db.schema.createTable("reservations", (table) => {
      table.increments("id").primary();
      table.string("check_in");
      table.string("check_out");
      table.integer("room_type");
      table.integer("guests");
      table.integer("children");
    });
    console.log('Tabela "reservations" criada.');
  }
})();

//rota para inserir uma reserva

app.post("/reservations", async (req, res) => {
  const { check_in, check_out, room_type, guests, children } = req.body;
  try {
    const [id] = await db("reservations").insert({
      check_in,
      check_out,
      room_type,
      guests,
      children,
    });
    res.status(201).json({ id });
  } catch (error) {
    res.status(500).send({ error: "Erro ao criar reserva" });
  }
});

//rota para listar reservas

app.get("/reservations", async (req, res) => {
  try {
    const reservations = await db("reservations").select("*");
    res.status(200).json(reservations);
  } catch (error) {
    res.status(500).send({ error: "Erro ao listar reservas" });
  }
});

app.listen(PORT, () => {
  console.log(`Servidor rodando na porta http://localhost:${PORT}`);
});
