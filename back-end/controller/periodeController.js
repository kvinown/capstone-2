// Controller untuk menggunakan class Fakultas
const PeriodeBeasiswa = require('../model/PeriodeBeasiswa');

const index = (req, res) => {
    // Buat instance Fakultas langsung tanpa menggunakan getInstance()
    new PeriodeBeasiswa().all((err, periodeBeasiswa) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        res.status(200).json({
            success: true,
            data: periodeBeasiswa,
        });
    });
}
const create = (req, res) => {
    res.status(200).json({ success: true, message: 'Create page' });
};

const store = (req, res) => {
    console.log('Recieved data from storing', req.body)
    const dataPeriode ={
        id: req.body.id,
        nama: req.body.nama,
        status: req.body.status,
    }
    console.log('Data for storing', dataPeriode)

    new PeriodeBeasiswa().save(dataPeriode, (err, result) => {
        if (err) {
            console.error('Error while saving periode Beasiswa:', err)
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message })
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result })
    })
}

const edit = (req, res) => {
    const id = req.params.id;
    new PeriodeBeasiswa().edit(id, (err, periodeBeasiswa) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        if (!periodeBeasiswa) {
            return res.status(404).json({
                success: false,
                message: `No Periode Beasiswa found with ID ${id}`,
            });
        }
        res.status(200).json({ success: true, data: periodeBeasiswa });
    });
}
const update = (req, res) => {
    console.log('Received data for updating', req.body);
    const dataPeriode ={
        id: req.body.id,
        nama: req.body.nama,
        status: req.body.status,
    }
    console.log('Data for update', dataPeriode);

    new PeriodeBeasiswa().update(dataPeriode, (err, result) => {
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
    new PeriodeBeasiswa().delete(id, (err, result) => {
        if (err) {
            console.error('Error while deleting periode beasiswa:', err);
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
