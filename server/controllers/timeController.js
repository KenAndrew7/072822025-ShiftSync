// server/controllers/timeController.js
const pool = require('../db');

const getAllTimeLogs = async (req, res) => {
  try {
    const result = await pool.query('SELECT * FROM time_tracking');
    res.json(result.rows);
  } catch (err) {
    console.error(err);
    res.status(500).send('Error fetching time logs');
  }
};

module.exports = {
  getAllTimeLogs,
};
