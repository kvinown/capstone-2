const express = require('express')

const router = express.Router()

const pengajuanBeasiswaController = require('../controller/pengajuanBeasiswaController')

// router.get('/api/fakultas-delete/:id', fakultasController.destroy)
// router.post('/api/fakultas-update', fakultasController.update)
// router.get('/api/fakultas-edit/:id', fakultasController.edit)
router.post('/api/pengajuanBeasiswa-store', pengajuanBeasiswaController.store)
router.get('/api/pengajuanBeasiswa', pengajuanBeasiswaController.index)

module.exports = router
