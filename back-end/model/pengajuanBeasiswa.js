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
        this.belongsTo('users', 'users_id', 'id', id, callback);
    }

    jenisBeasiswa(id, callback) {
        this.belongsTo('jenisBeasiswa', 'jenisBeasiswa_id', 'id', id, callback);
    }

    periodeBeasiswa(id, callback) {
        this.belongsTo('periodeBeasiswa', 'periodeBeasiswa_id', 'id', id, callback);
    }
}

module.exports = PengajuanBeasiswa;
