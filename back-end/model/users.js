const Model = require('./Model');

class Users extends Model {
    constructor() {
        super('users');
        if (!Users.instance) {
            Users.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return Users.instance;
    }
}

module.exports = Users;
