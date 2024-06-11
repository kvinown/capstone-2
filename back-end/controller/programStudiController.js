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
        id: req.params.id,
        nama: req.params.nama,
        fakultas_id: req.params.fakultas_id,
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
module.exports = {
    index,
    store
};
