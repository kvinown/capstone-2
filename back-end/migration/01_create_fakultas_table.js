// Migration file for 'fakultas' table
exports.up = function(knex) {
    return knex.schema.hasTable('fakultas').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('fakultas', function(table) {
                table.string('id', 15).primary();
                table.string('nama', 100);
                table.timestamp('created_at').defaultTo(knex.fn.now());
                table.timestamp('updated_at').defaultTo(knex.fn.now());
            });
        }
    });
};

exports.down = function(knex) {
    return knex.schema.dropTableIfExists('fakultas');
};