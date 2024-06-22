const express = require('express')

const router = express.Router()

const periodeController = require('../controller/periodeController')

router.get('/api/periode-delete/:id', periodeController.destroy)
router.post('/api/periode-update', periodeController.update)
router.get('/api/periode-edit/:id', periodeController.edit)
router.post('/api/periode-store', periodeController.store)
router.get('/api/periode', periodeController.index)

module.exports = router
