exports.seed = function(knex) {
    // Deletes ALL existing entries
    return knex('programStudi').del()
        .then(function () {
            // Inserts seed entries
            return knex('programStudi').insert([
                {
                    id: '1',
                    nama: 'Teknik Infomatika',
                    fakultas_id: '1'
                },
                {
                    id: '2',
                    nama: 'Sistem Informasi',
                    fakultas_id: '1'
                },
                {
                    id: '3',
                    nama: 'Elektro',
                    fakultas_id: '2'
                }
            ]);
        });
};
