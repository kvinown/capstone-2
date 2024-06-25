const express = require('express')

const router = express.Router()

const pengajuanBeasiswaController = require('../controller/pengajuanBeasiswaController')
const fakultasController = require("../controller/fakultasController");

router.get('/api/pengajuanBeasiswa/details/:users_id/:jenisBeasiswa_id/:periodeBeasiswa_id', pengajuanBeasiswaController.details)
router.post('/api/pengajuanBeasiswa-update', pengajuanBeasiswaController.update)
router.get('/api/pengajuanBeasiswa-edit/:id', pengajuanBeasiswaController.edit)
router.post('/api/pengajuanBeasiswa-store', pengajuanBeasiswaController.store)
router.get('/api/pengajuanBeasiswa', pengajuanBeasiswaController.index)

module.exports = router
