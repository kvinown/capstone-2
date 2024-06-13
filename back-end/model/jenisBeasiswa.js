const Model = require('./Model');

class JenisBeasiswa extends Model {
    constructor() {
        super('jenisBeasiswa');
        if (!JenisBeasiswa.instance) {
            JenisBeasiswa.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return JenisBeasiswa.instance;
    }
}

module.exports = JenisBeasiswa
