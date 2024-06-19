const express = require('express');
const router = express.Router();

const programStudiRouter = require('./route-programStudi');
const fakultasRouter = require('./route-fakultas');
const jenisBeasiswaRouter = require('./route-jenisBeasiswa')
const roleRouter = require('./route-role')

router.use(programStudiRouter);
router.use(fakultasRouter);
router.use(jenisBeasiswaRouter);
router.use(roleRouter);

module.exports = router;
