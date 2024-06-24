const Model = require('./Model');

class PengajuanBeasiswa extends Model {
    constructor() {
        super('pengajuanBeasiswa');
        if (!PengajuanBeasiswa.instance) {
            PengajuanBeasiswa.instance = this;
        }
        // Kembalikan instance yang sudah ada
        return PengajuanBeasiswa.instance;
    }


    users(id, callback) {
        const query = `
            SELECT ft.* FROM users ft
            JOIN pengajuanBeasiswa lt 
            ON lt.users_id = ft.id
            WHERE lt.users_id = ?
        `;
        this.db.query(query, [id], (err, results) => {
            if (err) return callback(err, null);
            if (results.length === 0) {
                return callback(null, null); // Return null if no data is found
            }
            callback(null, results[0]);
        });
    }

    jenisBeasiswa(id, callback) {
        const query = `
            SELECT ft.* FROM jenisBeasiswa ft
            JOIN pengajuanBeasiswa lt 
            ON lt.jenisBeasiswa_id = ft.id
            WHERE lt.jenisBeasiswa_id = ?
        `;
        this.db.query(query, [id], (err, results) => {
            if (err) return callback(err, null);
            if (results.length === 0) {
                return callback(null, null); // Return null if no data is found
            }
            callback(null, results[0]);
        });
    }

    periodeBeasiswa(id, callback) {
        const query = `
            SELECT ft.* FROM periodeBeasiswa ft
            JOIN pengajuanBeasiswa lt 
            ON lt.periodeBeasiswa_id = ft.id
            WHERE lt.periodeBeasiswa_id = ?
        `;
        this.db.query(query, [id], (err, results) => {
            if (err) return callback(err, null);
            if (results.length === 0) {
                return callback(null, null); // Return null if no data is found
            }
            callback(null, results[0]);
        });
    }
}

module.exports = PengajuanBeasiswa;
