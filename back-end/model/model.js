const mysql = require("mysql");
const config = require("../config/db_config");

class Model {
	constructor(table) {
		if (new.target === Model) {
			throw new TypeError("Cannot construct Abstract instances directly");
		}
		this.table = table;
		this.db = mysql.createConnection(config.db);
		this.db.connect((err) => {
			if (err) throw err;
			console.log(`MySQL connected to ${this.table} table`);
		});
	}

	all(callback) {
		const query = `SELECT * FROM ${this.table}`;
		this.db.query(query, (err, results) => {
			if (err) return callback(err, null);
			callback(null, results);
		});
	}

	find(id, callback) {
		const query = `SELECT * FROM ${this.table} WHERE id = ?`;
		this.db.query(query, [id], (err, results) => {
			if (err) return callback(err, null);
			callback(null, results[0]);
		});
	}
	edit(id, callback) {
		const query = `SELECT * FROM ${this.table} WHERE id = ?`;
		this.db.query(query, [id], (err, results) => {
			if (err) return callback(err, null);
			callback(null, results[0]);
		});
	}

	save(data, callback) {
		const query = `INSERT INTO ${this.table} SET ?`;
		this.db.query(query, data, (err, result) => {
			if (err) return callback(err, null);
			callback(null, result.insertId);
		});
	}

	update(data, callback) {
		const id = data.id;
		const query = `UPDATE ${this.table} SET ? WHERE id = ?`;
		this.db.query(query, [data, id], (err, result) => {
			if (err) return callback(err, null);
			callback(null, result.affectedRows);
		});
	}


	delete(id, callback) {
		const query = `DELETE FROM ${this.table} WHERE id = ?`;
		this.db.query(query, [id], (err, result) => {
			if (err) return callback(err, null);
			callback(null, result.affectedRows);
		});
	}
	belongsTo(foreignTable, foreignKey, localKey, id, callback) {
		const query = `
            SELECT ft.* FROM ${foreignTable} ft
            JOIN ${this.table} lt 
            ON lt.${foreignKey} = ft.${localKey}
            WHERE lt.id = ?
        `;
		this.db.query(query, [id], (err, results) => {
			if (err) return callback(err, null);
			if (results.length === 0) {
				return callback(null, null); // Return null if no data is found
			}
			callback(null, results[0]);
		});
	}

	hasMany(localTable, localKey, foreignKey, callback) {
		const query = `SELECT * FROM ${localTable} WHERE ${foreignKey} = ?`;
		this.db.query(query, [localKey], (err, results) => {
			if (err) return callback(err, null);
			callback(null, results);
		});
	}
}

module.exports = Model;
