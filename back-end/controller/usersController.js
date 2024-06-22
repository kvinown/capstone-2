const bcrypt = require('bcrypt')
const Users = require('../model/users')

const index = (req, res) => {
    new Users().all((err, users) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error'
            });
        }

        let usersData = [];
        let processed = 0;

        users.forEach(user => {
            new Users().role(user.role_id, (err, role) => {
                if (err) {
                    return res.status(500).json({
                        success: false,
                        message: 'Internal server error',
                        error: err.message
                    });
                }

                user.role = role;

                new Users().programStudi(user.programStudi_id, (err, programStudi) => {
                    if (err) {
                        return res.status(500).json({
                            success: false,
                            message: 'Internal server error',
                            error: err.message
                        });
                    }

                    user.programStudi = programStudi;

                    usersData.push(user);
                    processed++;

                    if (processed === users.length) {
                        res.status(200).json({
                            success: true,
                            data: usersData
                        });
                    }
                });
            });
        });
    });
};
const create = (req, res) => {
    res.status(200).json({success: true, message: 'Create Page'})
}

const store = (req, res) => {
    console.log('Received data from storing', req.body);
    // if (req.body.password !== req.body.password_confirmation) {
    //     return res.status(400).json({
    //         success: false,
    //         message: 'Password dan konfirmasi password tidak cocok'
    //     });
    // }
    // Hash password sebelum menyimpannya
    bcrypt.hash(req.body.password, 10, (err, hashedPassword) => {
        if (err) {
            console.error('Error while hashing password', err);
            return res.status(500).json({
                success: false,
                message: 'Internal Server Error',
                error: err.message
            });
        }

        // Ambil data dari request body
        const userData = {
            name: req.body.name,
            email: req.body.email,
            password: hashedPassword,
            role_id: req.body.role_id,
            programStudi_id: req.body.programStudi_id
        };


        console.log(userData)

        // Panggil method save dari model User untuk menyimpan data pengguna
        new Users().save(userData, (err, result) => {
            if (err) {
                console.error('Error while saving user', err);
                return res.status(500).json({
                    success: false,
                    message: 'Internal Server Error',
                    error: err.message
                });
            }

            // Jika berhasil disimpan, kirim respon sukses
            res.status(201).json({
                success: true,
                message: 'Data berhasil ditambah',
                data: result
            });
        });
    });
};
const edit = (req, res) => {
    const id = req.params.id
    new Users().edit(id, (err, user) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        res.status(200).json({ success: true, data: user});
    })
}

const update = (req, res) => {
    console.log('Recieved data from updating', req.body)
    bcrypt.hash(req.body.password, 10, (err, hashedPassword) => {
        if (err) {
            console.error('Error while hashing password', err);
            return res.status(500).json({
                success: false,
                message: 'Internal Server Error',
                error: err.message
            });
        }

        // Ambil data dari request body
        const userData = {
            id: req.body.id,
            name: req.body.name,
            email: req.body.email,
            password: hashedPassword,
            role_id: req.body.role_id,
            programStudi_id: req.body.programStudi_id
        };


        console.log('Data users for update',userData)

        // Panggil method update dari model User untuk menyimpan data pengguna
        new Users().update(userData, (err, result) => {
            if (err) {
                console.error('Error while saving user', err);
                return res.status(500).json({
                    success: false,
                    message: 'Internal Server Error',
                    error: err.message
                });
            }

            // Jika berhasil disimpan, kirim respon sukses
            res.status(201).json({
                success: true,
                message: 'Data berhasil diubah',
                data: result
            });
        });
    });
}

const destroy = (req, res) => {
    const id = req.params.id
    console.log('ID for delete', id)
    new Users().delete(id, (err, result) => {
        if (err) {
            console.error('Error while deleting users', err)
            return res.status(500).json({success: false, message: 'Internal Server Error', error: err.message})
        }
        res.status(200).json({ success: true, message: 'Data berhasil dihapus', data: result });
    })
}

module.exports = {
    index,
    create,
    store,
    edit,
    update,
    destroy
}

