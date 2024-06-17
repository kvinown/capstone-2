/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.hasTable('approvalProdi').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('approvalProdi', function(table) {
                table.string('id', 5).primary();
                table.dateTime('tanggal_approval');
                table.string('status', 45);
                table.string('programStudi_id', 5);
                table.foreign('programStudi_id').references('id').inTable('programStudi').onUpdate('CASCADE').onDelete('RESTRICT');
                table.string('pengajuanBeasiswa_id', 5);
                table.foreign('pengajuanBeasiswa_id').references('id').inTable('pengajuanBeasiswa').onUpdate('CASCADE').onDelete('RESTRICT');
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
    return knex.schema.dropTableIfExists('approvalProdi');
};
