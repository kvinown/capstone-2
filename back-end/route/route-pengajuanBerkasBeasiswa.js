const express = require('express')

const router = express.Router()

const pengajuanController = require('../controller/pengajuanBerkasBeasiswaController')
//
// // router.get('/api/fakultas-delete/:id', fakultasController.destroy)
// // router.post('/api/fakultas-update', fakultasController.update)
// // router.get('/api/fakultas-edit/:id', fakultasController.edit)
router.post('/api/pengajuanBerkasBeasiswa-store', pengajuanController.store)
router.get('/api/pengajuanBerkasBeasiswa', pengajuanController.index)
//
module.exports = router
