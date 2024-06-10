const path = require('path');

module.exports = {
    development: {
        client: 'mysql',
        connection: {
            host: 'localhost',
            user: 'root',
            password: 'root',
            database: 'capstone-2'
        },
        migrations: {
            directory: path.join(__dirname, '../migration') // Menggunakan path.join untuk menghindari kesalahan path
        },
        seeds: {
            directory: path.join(__dirname, '../seed') // Menggunakan path.join untuk menghindari kesalahan path
        }
    }
};
