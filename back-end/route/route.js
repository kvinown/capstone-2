const express = require('express');
const router = express.Router();

const programStudiRouter = require('./route-programStudi');
const fakultasRouter = require('./route-fakultas');
const jenisBeasiswaRouter = require('./route-jenisBeasiswa')
const roleRouter = require('./route-role')
const usersController = require('./route-users')
const periodeController = require('./route-periode')

router.use(programStudiRouter);
router.use(fakultasRouter);
router.use(jenisBeasiswaRouter);
router.use(roleRouter);
router.use(usersController);
router.use(periodeController);

module.exports = router;
