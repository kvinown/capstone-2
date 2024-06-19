const express = require('express')

const router = express.Router()

const fakultasController = require('../controller/fakultasController')

router.get('/api/fakultas-delete/:id', fakultasController.destroy)
router.post('/api/fakultas-update', fakultasController.update)
router.get('/api/fakultas-edit/:id', fakultasController.edit)
router.post('/api/fakultas-store', fakultasController.store)
router.get('/api/fakultas', fakultasController.index)

module.exports = router
