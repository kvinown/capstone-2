const express = require('express')

const router = express.Router()

const fakultasController = require('../controller/fakultasController')
const programStudiController = require('../controller/programStudiController')

router.get('/api/programStudi-delete/:id', programStudiController.destroy)
router.post('/api/programStudi/update', programStudiController.update)
router.get('/api/programStudi-edit/:id', programStudiController.edit)
router.post('/api/programStudi-store', programStudiController.store)
router.get('/api/programStudi-create', programStudiController.create)
router.get('/api/programStudi', programStudiController.index)

router.get('/api/fakultas', fakultasController.index)

module.exports = router
