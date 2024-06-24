const DokumenPengajuan = require('../model/dokumenPengajuan');
const index = (req, res) => {
    // Buat instance Fakultas langsung tanpa menggunakan getInstance()
    new DokumenPengajuan().all((err, pengajuanBeasiswa) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        res.status(200).json({
            success: true,
            data: pengajuanBeasiswa,
        });
    });
}
const create = (req, res) => {
    const data = {
        users_id: req.params.users_id,
        jenisBeasiswa_id: req.params.jenisBeasiswa_id,
        periodeBeasiswa_id: req.params.periodeBeasiswa_id,
    };
    console.log(data);
    res.status(200).json({
        success: true,
        data: data
    });
}

const store = (req, res) => {
    console.log('Recieved data from storing', req.body)
    const dataPengajuanDokumen ={
        users_id: req.body.users_id,
        periodeBeasiswa_id: req.body.periodeBeasiswa_id,
        jenisBeasiswa_id: req.body.jenisBeasiswa_id,
        jenisDokumen_id:req.body.jenisDokumen_id,
        path:req.body.path,
    }
    console.log('Data for storing', dataPengajuanDokumen)

    new DokumenPengajuan().save(dataPengajuanDokumen, (err, result) => {
        if (err) {
            console.error('Error while saving berkas Pengajuan:', err)
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message })
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result })
    })
}

module.exports = {
    index,
    create,
    store
};
