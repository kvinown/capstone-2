const express = require('express')

const router = express.Router()

const usersController = require('../controller/usersController')

router.get('/api/users-delete', usersController.destroy)
router.post('/api/users-update', usersController.update)
router.get('/api/users-edit/:id', usersController.edit)
router.post('/api/users-store', usersController.store)
router.get('/api/users', usersController.index)

module.exports = router
