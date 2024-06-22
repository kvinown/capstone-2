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
    jenisBeasiswa(id, callback)
    {
        this.belongsTo(
            'jenisBeasiswa',
            'jenisBeasiswa_id',
            'id',
            id,
            callback
        )
    }
    periodeBeasiswa(id, callback)
    {
        this.belongsTo(
            'periodeBeasiswa',
            'periodeBeasiswa_id',
            'id',
            id,
            callback
        )
    }
}

module.exports = TanggalPeriodeBeasiswa;
