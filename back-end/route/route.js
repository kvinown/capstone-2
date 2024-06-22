const express = require('express');
const router = express.Router();

const programStudiRouter = require('./route-programStudi');
const fakultasRouter = require('./route-fakultas');
const jenisBeasiswaRouter = require('./route-jenisBeasiswa')
const roleRouter = require('./route-role')
const periodeRouter = require('./route-periode')

router.use(programStudiRouter);
router.use(fakultasRouter);
router.use(jenisBeasiswaRouter);
router.use(roleRouter);
router.use(periodeRouter);

module.exports = router;
