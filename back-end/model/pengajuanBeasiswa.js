const Model = require('./Model');

class PengajuanBeasiswa extends Model {
    constructor() {
        super('pengajuanBeasiswa');
        if (!PengajuanBeasiswa.instance) {
            PengajuanBeasiswa.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return PengajuanBeasiswa.instance;
    }


    users(id, callback) {
        this.belongsTo(
            'users',
            'users_id',
            'id',
            id, callback
        )

    }

    jenisBeasiswa(id, callback) {
        this.belongsTo(
            'jenisBeasiswa',
            'jenisBeasiswa_id',
            'id',
            id, callback
        )
    }

    periodeBeasiswa(id, callback) {
        this.belongsTo(
            'periodeBeasiswa',
            'periodeBeasiswa_id',
            'id',
            id, callback
        )
    }
    editPengajuan(id, callback) {
        const query = `SELECT * FROM ${this.table} WHERE users_id = ?`;
        this.db.query(query, [id], (err, results) => {
            if (err) return callback(err, null);
            callback(null, results[0]);
        });
    }
    updateBeasiswa(data, callback) {
        const id = data.users_id;
        console.log(id);

        const query = `UPDATE ${this.table} SET ? WHERE users_id = ?`;
        this.db.query(query, [data, id], (err, result) => {
            if (err) return callback(err, null);
            callback(null, result.affectedRows);
        });
    }

    approveProdi(users_id, jenisBeasiswa_id, periodeBeasiswa_id, callback) {
        const query = `
            UPDATE pengajuanBeasiswa
            SET statusProdiApproved = 1
            WHERE (users_id = ?) AND (jenisBeasiswa_id = ?) AND (periodeBeasiswa_id = ?)
        `
        this.db.query(query, [users_id, jenisBeasiswa_id, periodeBeasiswa_id], (err, result) => {
            if (err) return callback(err, null);
            callback(null, result.affectedRows);
        })
    }
    approveFakultas(users_id, jenisBeasiswa_id, periodeBeasiswa_id, callback) {
        const query = `
            UPDATE pengajuanBeasiswa
            SET statusFakultasApproved = 1
            WHERE (users_id = ?) AND (jenisBeasiswa_id = ?) AND (periodeBeasiswa_id = ?)
        `
        this.db.query(query, [users_id, jenisBeasiswa_id, periodeBeasiswa_id], (err, result) => {
            if (err) return callback(err, null);
            callback(null, result.affectedRows);
        })
    }
}

module.exports = PengajuanBeasiswa;
