// Controller untuk menggunakan class Fakultas
const ProgramStudi = require('../model/programStudi');
const JenisBeasiswa = require('../model/jenisBeasiswa');

const index = (req, res) => {
    // Buat instance Fakultas langsung tanpa menggunakan getInstance()
    new JenisBeasiswa().all((err, jenisBeasiswa) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        res.status(200).json({
            success: true,
            data: jenisBeasiswa,
        });
    });
}
const create = (req, res) => {
    res.status(200).json({ success: true, message: 'Create page' });
};

const store = (req, res) => {
    console.log('Recieved data from storing', req.body)
    const jenisBeasiswa ={
        id: req.body.id,
        nama: req.body.nama,
    }
    console.log('Data for storing', jenisBeasiswa)

    new JenisBeasiswa().save(jenisBeasiswa, (err, result) => {
        if (err) {
            console.error('Error while saving program studi:', err)
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message })
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result })
    })
}

const edit = (req, res) => {
    const id = req.params.id;
    new JenisBeasiswa().edit(id, (err, jenisBeasiswa) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        if (!programStudi) {
            return res.status(404).json({
                success: false,
                message: `No Jenis Beasiswa found with ID ${id}`,
            });
        }
        res.status(200).json({ success: true, data: jenisBeasiswa });
    });
}


const update = (req, res) => {
    console.log('Received data for updating', req.body);
    const jenisBeasiswa = {
        id: req.body.id,
        nama: req.body.nama,
    };
    console.log('Data for update', jenisBeasiswa);

    new ProgramStudi().update(jenisBeasiswa, (err, result) => {
        if (err) {
            console.error('Error while updating program studi:', err);
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message });
        }
        res.status(201).json({ success: true, message: 'Data berhasil diubah', data: result });
    });
};


const destroy = (req, res) => {
    const id = req.params.id;
    console.log('ID for delete', id);
    new ProgramStudi().delete(id, (err, result) => {
        if (err) {
            console.error('Error while deleting jenis beasiswa:', err);
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
    destroy,
};
