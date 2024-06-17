/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */

exports.up = function(knex) {
    return knex.schema.hasTable('periodePengajuan').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('periodePengajuan', function(table) {
                table.string('id', 5).primary();
                table.string('nama', 100).unique();
                table.dateTime('tanggal_mulai');
                table.dateTime('tanggal_selesai');
                table.string('programStudi_id', 5);
                table.foreign('programStudi_id').references('id').inTable('programStudi').onUpdate('CASCADE').onDelete('RESTRICT');
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
    return knex.schema.dropTableIfExists('periodePengajuan');
};
