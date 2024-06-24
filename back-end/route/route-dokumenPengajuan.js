const express = require('express');
const router = express.Router();
const dokumenPengajuanController = require('../controller/dokumenPengajuanController');

router.post('/api/dokumenPengajuan-store', dokumenPengajuanController.store)
router.get('/api/dokumenPengajuan', dokumenPengajuanController.index)

module.exports = router;
