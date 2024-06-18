const Model = require('./Model');

class PeriodeBeasiswa extends Model {
    constructor() {
        super('periodeBeasiswa');
        if (!PeriodeBeasiswa.instance) {
            PeriodeBeasiswa.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return PeriodeBeasiswa.instance;
    }
}

module.exports = PeriodeBeasiswa;
