/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.hasTable('periodeBeasiswa').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('periodeBeasiswa', function (table) {
                table.string('id', 15).primary()
                table.string('nama')
                table.boolean('status')
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
    return knex.schema.dropTableIfExists('periodeBeasiswa');
};
