// server/controllers/projectController.js
const pool = require('../db');

const getAllProjects = async (req, res) => {
  try {
    const result = await pool.query('SELECT * FROM projects');
    res.json(result.rows);
  } catch (err) {
    console.error(err);
    res.status(500).send('Error fetching projects');
  }
};

module.exports = {
  getAllProjects,
};
