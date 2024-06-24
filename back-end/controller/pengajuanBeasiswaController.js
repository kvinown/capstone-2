const PengajuanBeasiswa = require('../model/pengajuanBeasiswa');

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

module.exports = {
    index,
    store,
    details
};
