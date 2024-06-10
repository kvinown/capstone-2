const Model = require('./Model');

class Fakultas extends Model {
    constructor() {
        super('fakultas');
        if (!Fakultas.instance) {
            Fakultas.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return Fakultas.instance;
    }
}

module.exports = Fakultas;