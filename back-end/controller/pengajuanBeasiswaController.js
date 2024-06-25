const PengajuanBeasiswa = require('../model/pengajuanBeasiswa');
const Fakultas = require("../model/fakultas");

const index = (req, res) => {
    const pengajuanBeasiswa = new PengajuanBeasiswa();
    pengajuanBeasiswa.all((err, pengajuanBeasiswas) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }

        let pengajuanBeasiswaData = [];
        let processed = 0;

        pengajuanBeasiswas.forEach(pengajuan => {
            pengajuanBeasiswa.jenisBeasiswa(pengajuan.jenisBeasiswa_id, (err, jenisBeasiswa) => {
                if (err) {
                    return res.status(500).json({
                        success: false,
                        message: 'Internal server error (JenisBeasiswa)',
                        error: err.message
                    });
                }

                pengajuan.jenisBeasiswa = jenisBeasiswa;

                pengajuanBeasiswa.periodeBeasiswa(pengajuan.periodeBeasiswa_id, (err, periodeBeasiswa) => {
                    if (err) {
                        return res.status(500).json({
                            success: false,
                            message: 'Internal server error',
                            error: err.message
                        });
                    }

                    pengajuan.periodeBeasiswa = periodeBeasiswa;

                    pengajuanBeasiswa.users(pengajuan.users_id, (err, user) => {
                        if (err) {
                            return res.status(500).json({
                                success: false,
                                message: 'Internal server error',
                                error: err.message
                            });
                        }

                        pengajuan.users = user;
                        pengajuanBeasiswaData.push(pengajuan);
                        processed++;

                        if (processed === pengajuanBeasiswas.length) {
                            res.status(200).json({
                                success: true,
                                data: pengajuanBeasiswaData
                            });
                        }
                    });
                });
            });
        });
    });
};

const store = (req, res) => {
    console.log('store:', req.body);
    const dataPengajuanBeasiswa = {
        users_id: req.body.user_id,
        periodeBeasiswa_id: req.body.periodeBeasiswa_id,
        jenisBeasiswa_id: req.body.jenisBeasiswa_id,
        ipk: req.body.ipk,
        point_portofolio: req.body.point_portofolio,
    };
    console.log(dataPengajuanBeasiswa);

    const pengajuanBeasiswa = new PengajuanBeasiswa();
    pengajuanBeasiswa.save(dataPengajuanBeasiswa, (err, result) => {
        if (err) {
            console.error('Error while saving:', err);
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message });
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result });
    });
};

const details = (req, res) => {
    const data = {
        users_id: req.params.users_id,
        jenisBeasiswa_id: req.params.jenisBeasiswa_id,
        periodeBeasiswa_id: req.params.periodeBeasiswa_id,
    };
    console.log(data);

    const pengajuanBeasiswa = new PengajuanBeasiswa();
    pengajuanBeasiswa.users(data.users_id, (err, user) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error users',
                error: err.message
            });
        }
        data.users = user;

        pengajuanBeasiswa.jenisBeasiswa(data.jenisBeasiswa_id, (err, jenisBeasiswa) => {
            if (err) {
                return res.status(500).json({
                    success: false,
                    message: 'Internal server error',
                    error: err.message
                });
            }
            data.jenisBeasiswa = jenisBeasiswa;

            pengajuanBeasiswa.periodeBeasiswa(data.periodeBeasiswa_id, (err, periodeBeasiswa) => {
                if (err) {
                    return res.status(500).json({
                        success: false,
                        message: 'Internal server error',
                        error: err.message
                    });
                }
                data.periodeBeasiswa = periodeBeasiswa;
                res.status(200).json({
                    success: true,
                    data: data
                });
            });
        });
    });
};

const edit = (req, res) => {
    const id = req.params.id;
    new PengajuanBeasiswa().editPengajuan(id, (err, pengajuanBeasiswa) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        if (!pengajuanBeasiswa) {
            return res.status(404).json({
                success: false,
                message: `No Data found with ID ${id}`,
            });
        }
        res.status(200).json({ success: true, data: pengajuanBeasiswa });
    });
}

const update = (req, res) => {
    console.log('Received data for updating', req.body);
    const dataPengajuanBeasiswa = {
        users_id: req.body.users_id,
        periodeBeasiswa_id: req.body.periodeBeasiswa_id,
        jenisBeasiswa_id: req.body.jenisBeasiswa_id,
        ipk: req.body.ipk,
        point_portofolio: req.body.point_portofolio,
        statusProdiApproved: req.body.statusProdiApproved,
        statusFakultasApproved: req.body.statusFakultasApproved,
    };
    console.log('Data for update', dataPengajuanBeasiswa);

    new PengajuanBeasiswa().updateBeasiswa(dataPengajuanBeasiswa, (err, result) => {
        if (err) {
            console.error('Error while updating beasiswa:', err);
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message });
        }
        res.status(201).json({ success: true, message: 'Data berhasil diubah', data: result });
    });
};


const approveProdi = (req, res) => {
    const { users_id, jenisBeasiswa_id, periodeBeasiswa_id } = req.params;

    const data = {
        users_id: users_id,
        jenisBeasiswa_id: jenisBeasiswa_id,
        periodeBeasiswa_id: periodeBeasiswa_id,
    };

    console.log('Request Data:', data);

    new PengajuanBeasiswa().approveProdi(users_id, jenisBeasiswa_id, periodeBeasiswa_id, (err, result) => {
        if (err) {
            console.error('Error approving Prodi:', err);
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }

        if (result === 0) {
            // No rows affected, meaning the combination of user_id, jenisBeasiswa_id, and periodeBeasiswa_id was not found
            return res.status(404).json({
                success: false,
                message: 'No matching record found to approve',
            });
        }

        res.status(200).json({
            success: true,
            data: result,
        });
    });
};
const approveFakultas = (req, res) => {
    const { users_id, jenisBeasiswa_id, periodeBeasiswa_id } = req.params;

    const data = {
        users_id: users_id,
        jenisBeasiswa_id: jenisBeasiswa_id,
        periodeBeasiswa_id: periodeBeasiswa_id,
    };

    console.log('Request Data:', data);

    new PengajuanBeasiswa().approveFakultas(users_id, jenisBeasiswa_id, periodeBeasiswa_id, (err, result) => {
        if (err) {
            console.error('Error approving Prodi:', err);
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }

        if (result === 0) {
            // No rows affected, meaning the combination of user_id, jenisBeasiswa_id, and periodeBeasiswa_id was not found
            return res.status(404).json({
                success: false,
                message: 'No matching record found to approve',
            });
        }

        res.status(200).json({
            success: true,
            data: result,
        });
    });
};


module.exports = {
    index,
    store,
    details,
    edit,
    update,
    approveProdi,
    approveFakultas
};
