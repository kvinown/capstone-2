exports.seed = function(knex) {
    // Deletes ALL existing entries
    return knex('fakultas').del()
        .then(function () {
            // Inserts seed entries
            return knex('fakultas').insert([
                { id: '1', nama: 'Teknologi Informasi' },
                { id: '2', nama: 'Teknik' }
            ]);
        });
};
