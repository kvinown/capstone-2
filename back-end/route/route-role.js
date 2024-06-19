const express = require('express')

const router = express.Router()

const roleController = require('../controller/roleController')

router.get('/api/role-delete/:id', roleController.destroy)
router.post('/api/role-update', roleController.update)
router.get('/api/role-edit/:id', roleController.edit)
router.post('/api/role-store', roleController.store)
router.get('/api/role', roleController.index)

module.exports = router
