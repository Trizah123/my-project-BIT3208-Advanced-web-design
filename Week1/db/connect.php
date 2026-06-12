// Week1/db/connection.js
// Database connection — will be used fully in Week 3+

const mysql = require('mysql2');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',          // add your MySQL password here if you set one
  database: 'medistore_db'
});

connection.connect((err) => {
  if (err) {
    console.error('❌ Database connection failed:', err.message);
    return;
  }
  console.log('✅ Database connected successfully!');
});

module.exports = connection;
