// server/routes/timeRoutes.js
const express = require('express');
const router = express.Router();
const { getAllTimeLogs } = require('../controllers/timeController');

router.get('/', getAllTimeLogs);

module.exports = router;
