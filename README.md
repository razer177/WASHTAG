# 🧺 WASHTAG – Laundry Management System

![PHP](https://img.shields.io/badge/PHP-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E.svg?style=for-the-badge&logo=javascript&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-In%20Development-blue?style=for-the-badge)

**WASHTAG** is a **BCA Final Year Mini Project** — a modern **web-based laundry management system** designed to streamline laundry bookings, order tracking, and user management for both customers and administrators.

Built using **PHP, JavaScript, SCSS, HTML, and Hack**, it demonstrates the full spectrum of **full-stack web development** — from authentication and database integration to responsive UI and admin controls.

---

## 🚀 Demo
🔗 **Live Demo:** *Coming Soon*  
🎥 *(You can add a short demo video or screenshots here)*  
📸 `assets/screenshot.png` *(optional preview image)*

---

## ✨ Features

✅ User Registration & Login  
✅ Service Booking & Order Tracking  
✅ Admin Dashboard for Managing Users & Orders  
✅ Responsive Front-End Interface  
✅ Notification System for Order Updates  
✅ Secure Authentication & Session Handling  
✅ Clean UI built with SCSS & JavaScript  

---

## 🧰 Tech Stack

| Layer | Technology |
|-------|-------------|
| **Frontend** | HTML, CSS, SCSS, JavaScript |
| **Backend** | PHP, Hack |
| **Database** | MySQL |
| **Tools** | Composer, npm, Git |
| **Server** | XAMPP / LAMP / MAMP |

---

## ⚙️ Requirements

- PHP **>= 7.4**  
- MySQL **>= 5.7**  
- Composer  
- Node.js & npm *(if front-end assets are managed)*  
- Local server (XAMPP/LAMP/MAMP or equivalent)

---

## 🛠️ Installation

Clone the repository:
```bash
git clone https://github.com/razer177/WASHTAG.git
cd WASHTAG
```

Install dependencies:
```bash
composer install
npm install        # optional, if using SCSS/JS bundler
```

Set up environment variables:
```bash
cp .env.example .env
# update DB credentials in .env
```

Import the database:
```bash
# Import database.sql into your MySQL server
```

Build front-end assets (if used):
```bash
npm run build
```

Start the development server:
```bash
php -S localhost:8000 -t public
```

Or place the project folder inside `htdocs` if using **XAMPP/MAMP**.

---

## 💻 Usage

1. Open the app at **http://localhost:8000** (or your local server URL)  
2. Register or log in as a **User** or **Admin**  
3. Book laundry services, track orders, and manage your profile  
4. Admins can manage orders, users, and feedback via the dashboard  

---

## 🗂️ Project Structure

```
WASHTAG/
├── public/         # Entry point and public assets
├── app/ or src/    # Core backend logic
├── assets/         # SCSS, JS, and images
├── database/       # SQL migrations or seed files
├── views/          # Front-end templates
└── .env.example    # Environment variables template
```

---

## 🤝 Contributing

This project was developed as part of the **BCA academic curriculum**.  
Contributions, suggestions, and improvements are welcome!

1. **Fork** the repository  
2. **Create** your feature branch (`feature/your-feature`)  
3. **Commit** and push your changes  
4. **Open a Pull Request** with a clear description  

---

## 👨‍💻 Credits

- **Developer:** [@razer177](https://github.com/razer177)  
- **Project:** WASHTAG – BCA Final Year Mini Project  
- **Supervisor:** *(Add your guide’s name)*  
- **Institution:** *(Add your college/university name)*  

---

## 📜 License

This project is licensed under the **MIT License**.  
See the [LICENSE](LICENSE) file for more details.

---

## 📬 Contact

- **GitHub:** [razer177](https://github.com/razer177)  
- **Email:** *(Add your email address)*  

---

> 🧼 **WASHTAG** — Simplify your laundry, amplify your time.
