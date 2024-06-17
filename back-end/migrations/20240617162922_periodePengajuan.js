/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = function(knex) {
    return knex.schema.hasTable('pengajuanBeasiswa').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('pengajuanBeasiswa', function(table) {
                table.string('id', 5).primary();
                table.float('ipk', 3, 2); // Menggunakan (3, 2) untuk menentukan presisi dan skala
                table.string('dokumen');
                table.dateTime('tanggal_pengajuan');
                table.string('user_id', 5);
                table.string('jenisBeasiswa_id', 5);
                table.string('periodePengajuan_id', 5);
                table.foreign('jenisBeasiswa_id').references('id').inTable('jenisBeasiswa').onDelete('RESTRICT').onUpdate('CASCADE');
                table.foreign('periodePengajuan_id').references('id').inTable('periodePengajuan').onDelete('RESTRICT').onUpdate('CASCADE');
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
    return knex.schema.dropTableIfExists('pengajuanBeasiswa');
};
