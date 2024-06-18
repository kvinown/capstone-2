/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.hasTable('jenisDokumen').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('jenisDokumen', function (table) {
                table.string('id', 5).primary()
                table.string('nama')
                table.timestamp('created_at').defaultTo(knex.fn.now())
                table.timestamp('updated_at').defaultTo(knex.fn.now())
            })
        }
    })
};

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.down = function(knex) {
    return knex.schema.dropTableIfExists('jenisDokumen');
};
