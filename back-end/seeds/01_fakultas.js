/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> } 
 */
exports.seed = async function(knex) {
  // Deletes ALL existing entries
  await knex('fakultas').del()
  await knex('fakultas').insert([
    {
      id: "1",
      nama: 'Teknologi Informasi'
    },
    {
      id: '2',
      nama: 'Teknik'
    },
    {
      id: '3',
      nama: 'Bahasa dan Budaya'
    }
  ]);
};
