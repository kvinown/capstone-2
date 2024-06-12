const express = require('express')

const router = express.Router()

const fakultasController = require('../controller/fakultasController')

router.post('/api/fakultas-store', fakultasController.store)

router.get('/api/fakultas', fakultasController.index)

module.exports = router
