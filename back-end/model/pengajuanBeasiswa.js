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
}

module.exports = PengajuanBeasiswa;
