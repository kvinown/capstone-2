const express = require('express');
const router = express.Router();

const programStudiRouter = require('./route-programStudi');
const fakultasRouter = require('./route-fakultas');

router.use(programStudiRouter);
router.use(fakultasRouter);

module.exports = router;
