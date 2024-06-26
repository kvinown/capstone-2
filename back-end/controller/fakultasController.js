// Controller untuk menggunakan class Fakultas
const Fakultas = require('../model/Fakultas');

const index = (req, res) => {
    // Buat instance Fakultas langsung tanpa menggunakan getInstance()
    new Fakultas().all((err, fakultas) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        res.status(200).json({
            success: true,
            data: fakultas,
        });
    });
}
const create = (req, res) => {
    res.status(200).json({ success: true, message: 'Create page' });
};

const store = (req, res) => {
    console.log('Recieved data from storing', req.body)
    const dataFakultas ={
        id: req.body.id,
        nama: req.body.nama,
    }
    console.log('Data for storing', dataFakultas)

    new Fakultas().save(dataFakultas, (err, result) => {
        if (err) {
            console.error('Error while saving fakultas:', err)
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message })
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result })
    })
}

const edit = (req, res) => {
    const id = req.params.id;
    new Fakultas().edit(id, (err, fakultas) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        if (!fakultas) {
            return res.status(404).json({
                success: false,
                message: `No Fakultas found with ID ${id}`,
            });
        }
        res.status(200).json({ success: true, data: fakultas });
    });
}
const update = (req, res) => {
    console.log('Received data for updating', req.body);
    const dataFakultas ={
        id: req.body.id,
        nama: req.body.nama,
    }
    console.log('Data for update', dataFakultas);

    new Fakultas().update(dataFakultas, (err, result) => {
        if (err) {
            console.error('Error while updating fakultas:', err);
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message });
        }
        res.status(201).json({ success: true, message: 'Data berhasil diubah', data: result });
    });
};

const destroy = (req, res) => {
    const id = req.params.id;
    console.log('ID for delete', id);
    new Fakultas().delete(id, (err, result) => {
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
