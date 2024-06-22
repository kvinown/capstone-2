const TanggalPeriodeBeasiswa = require('../model/tanggalPeriodeBeasiswa')

const index = (req, res) => {
    new TanggalPeriodeBeasiswa().all((err, tanggalPeriodeBeasiswas) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        let tanggalPeriodeData = []
        let processed = 0;

        tanggalPeriodeBeasiswas.forEach((tanggalPeriode => {
            tanggalPeriode.jenisBeasiswa_id;
            new TanggalPeriodeBeasiswa().jenisBeasiswa(
                tanggalPeriode.jenisBeasiswa_id,
                (err, jenisBeasiswa) => {
                    if (err) {
                        return res.status(500).json({
                            success: false,
                            message: 'Internal server error',
                            error: err.message
                        });
                    }
                    tanggalPeriode.jenisBeasiswa = jenisBeasiswa

                    new TanggalPeriodeBeasiswa().periodeBeasiswa(
                        tanggalPeriode.periodeBeasiswa_id,
                        (err, periodeBeasiswa) => {
                            if (err) {
                                return res.status(500).json({
                                    success: false,
                                    message: 'Internal server error',
                                    error: err.message
                                });
                            }
                            tanggalPeriode.periodeBeasiswa = periodeBeasiswa
                            tanggalPeriodeData.push(tanggalPeriode)
                            processed++

                            if (processed === tanggalPeriodeBeasiswas.length) {
                                res.status(200).json({
                                    success: true,
                                    data: tanggalPeriodeData
                                });
                            }
                        }
                    )
                }
            )
        }))
    });
}

const store = (req, res) => {
    console.log('Received data from storing', req.body)
    const tanggalPeriode = {
        jenisBeasiswa_id: req.body.jenisBeasiswa_id,
        periodeBeasiswa_id: req.body.periodeBeasiswa_id,
        start_date: req.body.start_date,
        end_date: req.body.end_date,
    }
    console.log('Data for storing', tanggalPeriode)

    new TanggalPeriodeBeasiswa().save(tanggalPeriode, (err, result) => {
        if (err) {
            console.error('Error while saving program studi:', err)
            return res.status(500).json({ success: false, message: 'Internal Server Error', error: err.message })
        }
        res.status(201).json({ success: true, message: 'Data berhasil ditambah', data: result })
    })
}

const edit = (req, res) => {
    const id = req.params.id
    new TanggalPeriodeBeasiswa().edit(id, (err, tanggalPeriode) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }

        res.status(200).json({ success: true, data: tanggalPeriode });
    })
}
module.exports = {
    index,
    store,
    edit,
}
