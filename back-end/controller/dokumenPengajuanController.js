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

const detail = (req, res) => {
    const { users_id, jenisBeasiswa_id, periodeBeasiswa_id, ipk, point_portofolio, statusProdiApproved, statusFakultasApproved } = req.params;

    const detailData = {
        users_id: users_id,
        jenisBeasiswa_id: jenisBeasiswa_id,
        periodeBeasiswa_id: periodeBeasiswa_id,
        ipk: ipk,
        point_portofolio: point_portofolio,
        statusProdiApproved: statusProdiApproved,
        statusFakultasApproved: statusFakultasApproved
    };

    console.log(detailData);

    new DokumenPengajuan().users(detailData.users_id, (err, users) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        detailData.users = users;

        new DokumenPengajuan().jenisBeasiswa(detailData.jenisBeasiswa_id, (err, jenisBeasiswa) => {
            if (err) {
                return res.status(500).json({
                    success: false,
                    message: 'Internal server error',
                });
            }
            detailData.jenisBeasiswa = jenisBeasiswa;

            new DokumenPengajuan().periodeBeasiswa(detailData.periodeBeasiswa_id, (err, periodeBeasiswa) => {
                if (err) {
                    return res.status(500).json({
                        success: false,
                        message: 'Internal server error',
                    });
                }
                detailData.periodeBeasiswa = periodeBeasiswa;

                new DokumenPengajuan().findDokumen(
                    detailData.users_id,
                    detailData.jenisBeasiswa_id,
                    detailData.periodeBeasiswa_id,
                    (err, dokumens) => {
                        if (err) {
                            return res.status(500).json({
                                success: false,
                                message: 'Internal server error',
                            });
                        }

                        let dokumenData = [];
                        let processed = 0;

                        if (dokumens.length === 0) {
                            detailData.dokumen = dokumenData;
                            return res.status(200).json({
                                success: true,
                                data: detailData
                            });
                        }

                        dokumens.forEach(dokum => {
                            new DokumenPengajuan().jenisDokumen(dokum.jenisDokumen_id, (err, jenisDokumen) => {
                                if (err) {
                                    return res.status(500).json({
                                        success: false,
                                        message: 'Internal server error',
                                        error: err.message
                                    });
                                }
                                dokum.jenisDokumen = jenisDokumen;
                                dokumenData.push(dokum);
                                processed++;

                                if (processed === dokumens.length) {
                                    detailData.dokumen = dokumenData;
                                    return res.status(200).json({
                                        success: true,
                                        data: detailData
                                    });
                                }
                            });
                        });
                    }
                );
            });
        });
    });
};


module.exports = {
    index,
    create,
    store,
    edit,
    update,
    destroy,
    detail
};
