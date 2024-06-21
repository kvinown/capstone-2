const Model = require('./Model');

class Users extends Model {
    constructor() {
        super('users');
        if (!Users.instance) {
            Users.instance = this;
        }
        return Users.instance;
    }

    role(id, callback) {
        this.belongsTo('role', 'role_id', 'id', id, callback);
    }
    programStudi(id, callback) {
        this.belongsTo('programStudi', 'programStudi_id', 'id', id, callback);
    }
}

module.exports = Users;
