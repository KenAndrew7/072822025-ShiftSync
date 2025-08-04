import express from 'express';
import pg from 'pg';
import dotenv from 'dotenv';

dotenv.config();

const { Pool } = pg;

const pool = new Pool({
  connectionString: process.env.DATABASE_URL,
  ssl: { rejectUnauthorized: false }
});

const app = express();
app.use(express.static('public'));

// ✅ This is your API route
app.get('/api/budget', async (req, res) => {
  try {
    const overallResult = await pool.query(`SELECT SUM(amount) AS total FROM budget`);
    const entriesResult = await pool.query(`SELECT SUM(amount) AS total FROM budget WHERE type = 'entry' AND date = CURRENT_DATE`);
    const expensesResult = await pool.query(`SELECT SUM(amount) AS total FROM budget WHERE type = 'expense' AND date = CURRENT_DATE`);

    res.json({
      overall: overallResult.rows[0].total || 0,
      entries: entriesResult.rows[0].total || 0,
      expenses: expensesResult.rows[0].total || 0
    });
  } catch (err) {
    console.error(err);
    res.status(500).send('Server error.');
  }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server running on http://localhost:${PORT}`));