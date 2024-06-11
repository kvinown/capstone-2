const express = require('express')

const router = express.Router()


const fakultasController = require('../controller/fakultasController')

router.get('/api/fakultas', fakultasController.index)
router.get('/api/fakultas-create', fakultasController.create)
router.post('/api/fakultas-store', fakultasController.store)

module.exports = router
