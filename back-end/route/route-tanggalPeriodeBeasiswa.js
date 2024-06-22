const express = require('express')

const router = express.Router()

const tanggalPeriodeBeasiswaController = require('../controller/tanggalPeriodeBeasiswaController')

router.get('/api/tanggalPeriodeBeasiswa-edit/:id', tanggalPeriodeBeasiswaController.edit)
router.post('/api/tanggalPeriodeBeasiswa-store', tanggalPeriodeBeasiswaController.store)
router.get('/api/tanggalPeriodeBeasiswa', tanggalPeriodeBeasiswaController.index)

module.exports = router
