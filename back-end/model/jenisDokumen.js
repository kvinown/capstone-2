const Model = require('./Model');

class JenisDokumen extends Model {
    constructor() {
        super('jenisDokumen');
        if (!JenisDokumen.instance) {
            JenisDokumen.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return JenisDokumen.instance;
    }
}

module.exports = JenisDokumen;
