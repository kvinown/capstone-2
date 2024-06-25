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
            directory: 'D:\\Kuliah - Kevin Owen\\SMT4\\PWL\\Project\\capstone-2\\capstone-2\\back-end\\migrations'
        },
        seeds: {
            directory: 'D:\\Kuliah - Kevin Owen\\SMT4\\PWL\\Project\\capstone-2\\capstone-2\\back-end\\seeds'
        }
    }
};
