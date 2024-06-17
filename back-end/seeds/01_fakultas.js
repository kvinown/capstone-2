/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.seed = async function(knex) {
  // Disable foreign key checks
  await knex.raw('SET foreign_key_checks = 0');

  // Deletes ALL existing entries
  await knex('programStudi').del(); // Clear dependent table first
  await knex('fakultas').del();

  // Insert new entries
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

  // Enable foreign key checks
  await knex.raw('SET foreign_key_checks = 1');
};
