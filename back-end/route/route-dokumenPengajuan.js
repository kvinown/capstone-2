const express = require('express');
const router = express.Router();
const dokumenPengajuanController = require('../controller/dokumenPengajuanController');

router.get('/api/dokumenPengajuan-detail/:users_id/:jenisBeasiswa_id/:periodeBeasiswa_id/:ipk/:point_portofolio', dokumenPengajuanController.detail)
router.get('/api/dokumenPengajuan-delete/:id', dokumenPengajuanController.destroy)
router.post('/api/dokumenPengajuan-update', dokumenPengajuanController.update)
router.get('/api/dokumenPengajuan-edit/:id', dokumenPengajuanController.edit)
router.post('/api/dokumenPengajuan-store', dokumenPengajuanController.store)
router.get('/api/dokumenPengajuan', dokumenPengajuanController.index)

module.exports = router;
