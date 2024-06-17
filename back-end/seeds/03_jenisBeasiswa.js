/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> } 
 */
exports.seed = async function(knex) {
  // Deletes ALL existing entries
  await knex('jenisBeasiswa').del()
  await knex('jenisBeasiswa').insert([
    {
      id: "1",
      nama: 'Akademik Internal'
    },
    {
      id: '2',
      nama: 'Non Akademik Internal'
    },
    {
      id: '3',
      nama: 'Maranatha Peduli'
    }
  ]);
};
