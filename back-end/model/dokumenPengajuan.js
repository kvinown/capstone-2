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
}

module.exports = DokumenPengajuan;
