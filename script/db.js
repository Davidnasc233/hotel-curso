const knex = require("knex");

const db = knex({
    client: "sqlite3",
    connection: {
        filename: "../database/hotel.db"
    },
    useNullAsDefault: true
});

module.exports = db;