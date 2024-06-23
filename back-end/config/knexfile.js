const path = require('path');

module.exports = {
    development: {
        client: 'mysql',
        connection: {
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'capstone-2'
        },
        migrations: {
            directory: '/Users/jov/Documents/Kuliah/Pemrograman web lanjut/TUBES UAS/capstone-2/back-end/migrations'// Menggunakan path.join untuk menghindari kesalahan path
        },
        seeds: {
            directory: '/Users/jov/Documents/Kuliah/Pemrograman web lanjut/TUBES UAS/capstone-2/back-end/seeds' // Menggunakan path.join untuk menghindari kesalahan path
        }
    }
};
