const express = require('express')

const router = express.Router()

const jenisBeasiswaController = require('../controller/jenisBeasiswaController')

router.get('/api/jenisBeasiswa-delete/:id', jenisBeasiswaController.destroy)
router.post('/api/jenisBeasiswa-update', jenisBeasiswaController.update)
router.get('/api/jenisBeasiswa-edit/:id', jenisBeasiswaController.edit)
router.post('/api/jenisBeasiswa-store', jenisBeasiswaController.store)
router.get('/api/jenisBeasiswa', jenisBeasiswaController.index)

module.exports = router
