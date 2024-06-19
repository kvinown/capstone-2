const Role = require("../model/role");

const index = (req, res) => {
    // Buat instance Fakultas langsung tanpa menggunakan getInstance()
    new Role().all((err, role) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        res.status(200).json({
            success: true,
            data: role,
        });
    });
}
const create = (req, res) => {
    res.status(200).json({ success: true, message: 'Create page' });
};

const store = (req, res) => {
    console.log('Recieved data from storing', req.body)
    const dataRole ={
        id: req.body.id,
        nama: req.body.nama,
    }
    console.log('Data for storing', dataRole)

    new Role().save(dataRole, (err, result) => {
        if (err) {
            console.error('Error while saving role', err)
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message })
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result })
    })
}

const edit = (req, res) => {
    const id = req.params.id;
    new Role().edit(id, (err, role) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        if (!role) {
            return res.status(404).json({
                success: false,
                message: `No Role found with ID ${id}`,
            });
        }
        res.status(200).json({ success: true, data: role });
    });
}
const update = (req, res) => {
    console.log('Received data for updating', req.body);
    const dataRole ={
        id: req.body.id,
        nama: req.body.nama,
    }
    console.log('Data for update', dataRole);

    new Role().update(dataRole, (err, result) => {
        if (err) {
            console.error('Error while updating role:', err);
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message });
        }
        res.status(201).json({ success: true, message: 'Data berhasil diubah', data: result });
    });
};

const destroy = (req, res) => {
    const id = req.params.id;
    console.log('ID for delete', id);
    new Role().delete(id, (err, result) => {
        if (err) {
            console.error('Error while deleting fakultas:', err);
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message });
        }
        res.status(200).json({ success: true, message: 'Data berhasil dihapus', data: result });
    });
}

module.exports = {
    index,
    create,
    store,
    edit,
    update,
    destroy
};