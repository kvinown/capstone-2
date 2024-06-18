/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.hasTable('jenisBeasiswa').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('jenisBeasiswa', function (table) {
                table.string('id', 5).primary()
                table.string('nama', 100).unique()
                table.timestamp('created_at').defaultTo(knex.fn.now());
                table.timestamp('updated_at').defaultTo(knex.fn.now());
            })
        }
    })
};

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.down = function(knex) {
    return knex.schema.dropTableIfExists('jenisBeasiswa');
};
