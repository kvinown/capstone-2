const express = require('express')

const router = express.Router()

const fakultasController = require('../controller/fakultasController')
const programStudiController = require('../controller/programStudiController')

router.get('/api/fakultas', fakultasController.index)
router.get('/api/programStudi', programStudiController.index)

module.exports = router
