/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.up = async function(knex) {
    // Create 'users' table
    await knex.schema.hasTable('users').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('users', function (table) {
                table.increments('id');
                table.string('name');
                table.string('email').unique();
                table.timestamp('email_verified_at').nullable();
                table.string('password');
                table.string('role_id', 5)
                table.string('programStudi_id', 5)
                table.foreign('role_id').references('id').inTable('role').onDelete('RESTRICT').onUpdate('CASCADE')
                table.foreign('programStudi_id').references('id').inTable('programStudi').onDelete('RESTRICT').onUpdate('CASCADE')
                table.string('remember_token', 100).nullable();
                table.timestamps(true, true); // 'created_at' and 'updated_at' with current timestamp as default
            });
        }
    });

    // Create 'password_reset_tokens' table
    await knex.schema.hasTable('password_reset_tokens').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('password_reset_tokens', function (table) {
                table.string('email').primary(); // Primary key
                table.string('token');
                table.timestamp('created_at').nullable();
            });
        }
    });

    // Create 'sessions' table
    await knex.schema.hasTable('sessions').then(function(exists) {
        if (!exists) {
            return knex.schema.createTable('sessions', function (table) {
                table.string('id').primary(); // Primary key
                table.integer('user_id').unsigned().nullable().index();
                table.string('ip_address', 45).nullable();
                table.text('user_agent').nullable();
                table.text('payload');
                table.integer('last_activity').index();

                // Set foreign key constraint on 'user_id'
                table.foreign('user_id').references('id').inTable('users').onDelete('CASCADE');
            });
        }
    });
};

/**
 * @param { import("knex").Knex } knex
 * @returns { Promise<void> }
 */
exports.down = async function(knex) {
    await knex.schema.dropTableIfExists('users');
    await knex.schema.dropTableIfExists('password_reset_tokens');
    await knex.schema.dropTableIfExists('sessions');

};
