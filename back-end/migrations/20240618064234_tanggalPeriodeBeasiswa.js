/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.hasTable('tanggalPeriodeBeasiswa').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('tanggalPeriodeBeasiswa', function (table) {
                table.increments('id')
                table.string('jenisBeasiswa_id',5)
                table.string('periodeBeasiswa_id',15)
                table.dateTime('start_date')
                table.dateTime('end_date')
                table.foreign('jenisBeasiswa_id').references('id').inTable('jenisBeasiswa').onDelete('RESTRICT').onUpdate('CASCADE')
                table.foreign('periodeBeasiswa_id').references('id').inTable('periodeBeasiswa').onDelete('RESTRICT').onUpdate('CASCADE')
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
    return knex.schema.dropTableIfExists('tanggalPeriodeBeasiswa');
};
