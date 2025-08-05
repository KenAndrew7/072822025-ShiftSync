// server/controllers/resourceController.js
const pool = require('../db');

const getAllResources = async (req, res) => {
  try {
    const result = await pool.query('SELECT * FROM resource_allocation');
    res.json(result.rows);
  } catch (err) {
    console.error(err);
    res.status(500).send('Error fetching resource allocation');
  }
};

module.exports = {
  getAllResources,
};