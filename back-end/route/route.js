const express = require('express');
const router = express.Router();

const programStudiRouter = require('./route-programStudi');
const fakultasRouter = require('./route-fakultas');
const jenisBeasiswaRouter = require('./route-jenisBeasiswa')
const roleRouter = require('./route-role')
const usersRouter = require('./route-users')
const periodeRouter = require('./route-periode')
const tanggalPeriodeRouter = require('./route-tanggalPeriodeBeasiswa')
const pengajuanBeasiswaRouter = require('./route-pengajuanBeasiswa')
const dokumenBeasiswaRouter = require('./route-dokumenPengajuan')

router.use(programStudiRouter);
router.use(fakultasRouter);
router.use(jenisBeasiswaRouter);
router.use(roleRouter);
router.use(usersRouter);
router.use(periodeRouter);
router.use(tanggalPeriodeRouter);
router.use(pengajuanBeasiswaRouter);
router.use(dokumenBeasiswaRouter);

module.exports = router;
