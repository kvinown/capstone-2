/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.hasTable('pengajuanBeasiswa').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('pengajuanBeasiswa', function (table) {
                table.integer('users_id').unsigned();
                table.string('periodeBeasiswa_id', 15);
                table.string('jenisBeasiswa_id', 5);
                table.integer('ipk');
                table.integer('point_portofolio');
                table.boolean('statusProdiApproved').defaultTo(false);
                table.boolean('statusFakultasApproved').defaultTo(false);
                table.timestamp('created_at').defaultTo(knex.fn.now());
                table.timestamp('updated_at').defaultTo(knex.fn.now());

                // Define composite primary key
                table.primary(['users_id', 'periodeBeasiswa_id', 'jenisBeasiswa_id']);

                // Set foreign key constraints
                table.foreign('users_id').references('id').inTable('users').onDelete('RESTRICT').onUpdate('CASCADE');
                table.foreign('periodeBeasiswa_id').references('id').inTable('periodeBeasiswa').onDelete('RESTRICT').onUpdate('CASCADE');
                table.foreign('jenisBeasiswa_id').references('id').inTable('jenisBeasiswa').onDelete('RESTRICT').onUpdate('CASCADE');
            });
        }
    });
};

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.down = function(knex) {
    return knex.schema.dropTableIfExists('pengajuanBeasiswa');
};
