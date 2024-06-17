/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.hasTable('programStudi').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('programStudi', function(table) {
                table.string('id', 5).primary();
                table.string('nama_program_Studi', 100).unique();
                table.string('fakultas_id', 5);
                table.foreign('fakultas_id').references('id').inTable('fakultas').onDelete('RESTRICT').onUpdate('CASCADE');
                table.timestamp('created_at').defaultTo(knex.fn.now());
                table.timestamp('updated_at').defaultTo(knex.fn.now());
            });
        }
    });
};

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.down = function(knex) {
    return knex.schema.dropTableIfExists('programStudi');
};
