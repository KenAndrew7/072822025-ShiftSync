// server/controllers/taskController.js
const pool = require('../db');

const getAllTasks = async (req, res) => {
  try {
    const result = await pool.query('SELECT * FROM tasks');
    res.json(result.rows);
  } catch (err) {
    console.error(err);
    res.status(500).send('Error fetching tasks');
  }
};

module.exports = {
  getAllTasks,
};
