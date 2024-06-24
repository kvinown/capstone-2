// Controller untuk menggunakan class Fakultas
const PengajuanDokumen = require('../model/dokumenPengajuan');

const index = (req, res) => {
    // Buat instance Fakultas langsung tanpa menggunakan getInstance()
    new PengajuanDokumen().all((err, pengajuanBeasiswa) => {
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
    res.status(200).json({ success: true, message: 'Create page' });
};

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

    new PengajuanDokumen().save(dataPengajuanDokumen, (err, result) => {
        if (err) {
            console.error('Error while saving berkas Pengajuan:', err)
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message })
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result })
    })
}

// /*const edit = (req, res) => {
//     const id = req.params.id;
//     new Fakultas().edit(id, (err, fakultas) => {
//         if (err) {
//             return res.status(500).json({
//                 success: false,
//                 message: 'Internal server error',
//             });
//         }
//         if (!fakultas) {
//             return res.status(404).json({
//                 success: false,
//                 message: `No Fakultas found with ID ${id}`,
//             });
//         }
//         res.status(200).json({ success: true, data: fakultas });
//     });
// }
// const update = (req, res) => {
//     console.log('Received data for updating', req.body);
//     const dataFakultas ={
//         id: req.body.id,
//         nama: req.body.nama,
//     }
//     console.log('Data for update', dataFakultas);
//
//     new Fakultas().update(dataFakultas, (err, result) => {
//         if (err) {
//             console.error('Error while updating fakultas:', err);
//             return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message });
//         }
//         res.status(201).json({ success: true, message: 'Data berhasil diubah', data: result });
//     });
// };
//
// const destroy = (req, res) => {
//     const id = req.params.id;
//     console.log('ID for delete', id);
//     new Fakultas().delete(id, (err, result) => {
//         if (err) {
//             console.error('Error while deleting fakultas:', err);
//             return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message });
//         }
//         res.status(200).json({ success: true, message: 'Data berhasil dihapus', data: result });
//     });
// }*/
//
module.exports = {
    index,
    create,
    store,
    // edit,
    // update,
    // destroy
};
