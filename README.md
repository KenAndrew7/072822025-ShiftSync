# 💼 ShiftSync – Project Management Web App

A modern full-stack web application designed for project management and productivity, using **Node.js** for the backend, **Bootstrap + HTML/CSS** for the frontend, and **Neon** as the PostgreSQL database.

---

## 🌟 Features

- ⚙️ **Node.js + Express Backend** — Fast and scalable server-side logic
- 🎨 **Bootstrap + HTML5/CSS3** — Responsive and clean UI built with modern CSS framework
- 🗃️ **Neon PostgreSQL Database** — Serverless, scalable, and blazing-fast Postgres hosting
- 🔐 **Environment variable support** — Clean `.env` integration for secrets and configuration
- 🧱 **Modular folder structure** — Organized and scalable codebase
- 📝 **Basic user authentication & CRUD operations**
- 📊 **Pages for Projects, Analytics, Billing, Resources, Time Tracking, and Cost Tracking**

---

## 📁 Project Structure

```plaintext
ShiftSync/
├── client/                      # Frontend (Bootstrap HTML files)
│   ├── index.html
│   ├── login.html
│   ├── register.html
│   ├── dashboard.html
│   ├── projects.html           # ✅ Connected to backend /api/projects
│   ├── tasks.html              # (Optional) Can be made to fetch /api/tasks
│   ├── analytics.html
│   ├── billing.html
│   ├── resources.html          # UI ready, no data yet from DB
│   ├── time-tracking.html      # UI ready, no data yet from DB
│   └── styles.css              # Optional custom styles (if any)
│
├── server/                     # Backend (Node.js + Express)
│   ├── controllers/            # Logic for handling DB queries
│   │   ├── projectController.js
│   │   ├── taskController.js
│   │   ├── resourceController.js
│   │   └── timeController.js
│   │
│   ├── routes/                 # Express routes (API entrypoints)
│   │   ├── projectRoutes.js
│   │   ├── taskRoutes.js
│   │   ├── resourceRoutes.js
│   │   └── timeRoutes.js
│   │
│   ├── db/
│   │   └── index.js            # Database pool connection to Neon
│
│   ├── .env                    # Neon DB credentials (keep private)
│   ├── .gitignore              # node_modules, .env ignored
│   ├── package.json            # Dependencies and scripts
│   └── server.js               # Main Express server file
│
└── README.md                   # Your project overview
```

## 🧪 Tech Stack

| Category         | Technology              |
|------------------|-------------------------|
| **Backend**      | Node.js, Express.js     |
| **Frontend**     | Bootstrap, HTML5, CSS3  |
| **Database**     | Neon PostgreSQL         |
| **Deployment**   | Render / Vercel / Fly.io|
| **Environment**  | dotenv                  |

## License

MIT — use freely!
