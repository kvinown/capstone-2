const Model = require('./Model');

class DokumenPengajuan extends Model {
    constructor() {
        super('dokumenPengajuan');
        if (!DokumenPengajuan.instance) {
            DokumenPengajuan.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return DokumenPengajuan.instance;
    }

    findPengajuan(users_id, jenisBeasiswa_id, periodeBeasiswa_id, callback) {
        const query =
            'SELECT * FROM pengajuanBeasiswa WHERE users_id = ? AND jenisBeasiswa_id = ? AND periodeBeasiswa_id = ?';
        this.db.query(query, [users_id, jenisBeasiswa_id, periodeBeasiswa_id], (err, result) => {
            if (err) return callback(err, null);
            callback(null, result);
        });
    }


    users(id, callback) {
        this.belongsTo(
            'users',
            'users_id',
            'id',
            id,
            callback
        );
    }

    jenisBeasiswa(id, callback) {
        this.belongsTo(
            'jenisBeasiswa',
            'jenisBeasiswa_id',
            'id',
            id,
            callback
        );
    }

    periodeBeasiswa(id, callback) {
        this.belongsTo(
            'periodeBeasiswa',
            'periodeBeasiswa_id',
            'id',
            id,
            callback
        );
    }
    editBerkas(id, callback) {
        const query = `SELECT * FROM ${this.table} WHERE users_id = ?`;
        this.db.query(query, [id], (err, results) => {
            if (err) return callback(err, null);
            callback(null, results);
        });
    }

    updateBerkas(data, callback) {
        const users_id = data.users_id;
        const jenisDokumen_id = data.jenisDokumen_id;
        const query = `UPDATE ${this.table} SET path = ? WHERE users_id = ? AND jenisDokumen_id = ?`;
        this.db.query(query, [data.path, users_id, jenisDokumen_id], (err, result) => {
            if (err) return callback(err, null);
            callback(null, result.affectedRows);
        });
    }
    deleteBerkas(id, callback) {
        const query = `DELETE FROM ${this.table} WHERE users_id = ?`;
        this.db.query(query, [id], (err, result) => {
            if (err) return callback(err, null);
            callback(null, result.affectedRows);
        });
    }

}

module.exports = DokumenPengajuan;
