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
}

module.exports = DokumenPengajuan;
