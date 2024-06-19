const Model = require('./Model');

class Role extends Model {
    constructor() {
        super('role');
        if (!Role.instance) {
            Role.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return Role.instance;
    }
}

module.exports = Role;