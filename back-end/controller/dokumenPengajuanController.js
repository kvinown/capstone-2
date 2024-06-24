const DokumenPengajuan = require('../model/dokumenPengajuan');
const Fakultas = require("../model/fakultas");
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

const edit = (req, res) => {
    const id = req.params.id;
    new DokumenPengajuan().editBerkas(id, (err, dokumenPengajuan) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        if (!dokumenPengajuan || dokumenPengajuan.length === 0) {
            return res.status(404).json({
                success: false,
                message: `No Berkas found with ID ${id}`,
            });
        }

        const dokumen = {
            users_id: dokumenPengajuan[0].users_id,
            periodeBeasiswa_id: dokumenPengajuan[0].periodeBeasiswa_id,
            jenisBeasiswa_id: dokumenPengajuan[0].jenisBeasiswa_id,
            dokumenPengajuan: null,
            suratEkonomiLemah: null,
            aktivisOrganisasi: null
        };

        dokumenPengajuan.forEach(doc => {
            if (doc.jenisDokumen_id === '1') {
                dokumen.dokumenPengajuan = doc.path;
            } else if (doc.jenisDokumen_id === '2') {
                dokumen.suratEkonomiLemah = doc.path;
            } else if (doc.jenisDokumen_id === '3') {
                dokumen.aktivisOrganisasi = doc.path;
            }
        });

        res.status(200).json({ success: true, data: dokumen });
    });
};

const update = (req, res) => {
    console.log('Received data for updating', req.body);
    const dataPengajuanDokumen ={
        users_id: req.body.users_id,
        periodeBeasiswa_id: req.body.periodeBeasiswa_id,
        jenisBeasiswa_id: req.body.jenisBeasiswa_id,
        jenisDokumen_id:req.body.jenisDokumen_id,
        path:req.body.path,
    }
    console.log('Data for update', dataPengajuanDokumen);

    new DokumenPengajuan().updateBerkas(dataPengajuanDokumen, (err, result) => {
        if (err) {
            console.error('Error while updating dokumen:', err);
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message });
        }else{
            console.log("Data sudah diubah")
        }

        res.status(201).json({ success: true, message: 'Data berhasil diubah', data: result });
    });
};

const destroy = (req, res) => {
    const id = req.params.id;
    console.log('ID for delete', id);
    new DokumenPengajuan().deleteBerkas(id, (err, result) => {
        if (err) {
            console.error('Error while deleting dokumen:', err);
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
