/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.hasTable('dokumenPengajuan').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('dokumenPengajuan', function (table) {
                table.integer('users_id').unsigned();
                table.string('periodeBeasiswa_id', 15);
                table.string('jenisBeasiswa_id', 5);
                table.string('jenisDokumen_id', 5);
                table.string('path');

                table.primary(['users_id', 'periodeBeasiswa_id', 'jenisBeasiswa_id', 'jenisDokumen_id']);

                // Set foreign key constraints with shorter names
                table.foreign(['users_id', 'periodeBeasiswa_id', 'jenisBeasiswa_id'], 'fk_dokumen_pengajuan_pbeasiswa')
                    .references(['users_id', 'periodeBeasiswa_id', 'jenisBeasiswa_id'])
                    .inTable('pengajuanBeasiswa')
                    .onDelete('RESTRICT')
                    .onUpdate('CASCADE');
                table.foreign('jenisDokumen_id', 'fk_dokumen_jenisDokumen')
                    .references('id')
                    .inTable('jenisDokumen')
                    .onDelete('RESTRICT')
                    .onUpdate('CASCADE');

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
    return knex.schema.dropTableIfExists('dokumenPengajuan');
};
