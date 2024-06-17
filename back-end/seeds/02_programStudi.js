/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> } 
 */
exports.seed = async function(knex) {
  // Deletes ALL existing entries
  await knex('programStudi').del()
  await knex('programStudi').insert([
    {
      id: "1",
      nama: 'Teknik Informatika',
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
};
