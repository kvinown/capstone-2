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
            console.error('Error while saving program studi:', err)
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message })
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result })
    })
}


module.exports = {
    index, create,store
};
