const Model = require('./Model');

class TanggalPeriodeBeasiswa extends Model {
    constructor() {
        super('tanggalPeriodeBeasiswa');
        if (!TanggalPeriodeBeasiswa.instance) {
            TanggalPeriodeBeasiswa.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return TanggalPeriodeBeasiswa.instance;
    }
}

module.exports = TanggalPeriodeBeasiswa;
