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
}

module.exports = ProgramStudi;