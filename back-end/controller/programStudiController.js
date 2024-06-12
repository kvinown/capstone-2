// Controller untuk menggunakan class Fakultas
const ProgramStudi = require('../model/programStudi');

const index = (req, res) => {
    // Buat instance Fakultas langsung tanpa menggunakan getInstance()
    new ProgramStudi().all((err, fakultas) => {
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
    const programStudi ={
        id: req.body.id,
        nama: req.body.nama,
        fakultas_id: req.body.fakultas_id,
    }
    console.log('Data for storing', programStudi)

    new ProgramStudi().save(programStudi, (err, result) => {
        if (err) {
            console.error('Error while saving program studi:', err)
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message })
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result })
    })
}

const edit = (req, res) => {
    const id = req.params.id;
    new ProgramStudi().edit(id, (err, programStudi) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        if (!programStudi) {
            return res.status(404).json({
                success: false,
                message: `No programStudi found with ID ${id}`,
            });
        }
        res.status(200).json({ success: true, data: programStudi });
    });
}


const update = (req, res) => {
    console.log('Received data for updating', req.body);
    const programStudi = {
        id: req.body.id,
        nama: req.body.nama,
        fakultas_id: req.body.fakultas_id,
    };
    console.log('Data for update', programStudi);

    new ProgramStudi().update(programStudi, (err, result) => {
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
            console.error('Error while deleting program studi:', err);
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
