const Model = require('./Model');

class ProgramStudi extends Model {
    constructor() {
        super('programStudi');
        if (!ProgramStudi.instance) {
            ProgramStudi.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return ProgramStudi.instance;
    }

    fakultas(id, callback) {
        this.belongsTo('fakultas', 'fakultas_id', 'id', id, callback);
    }
}

module.exports = ProgramStudi;
