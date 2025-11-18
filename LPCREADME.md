# FPL Login System
A simple login + logout system added to protect the main page.
---

## Test Account
| Field | Value |
|-------|-------|
| Email | **lipengcheng@example.com** |
| Password | **Lipengcheng1117!** |

Use this to access the system.

---

## 🚀 How to Run
1. Start **Apache** and **MySQL** in XAMPP  
2. Import the provided SQL file into phpMyAdmin  
3. Open in browser:http://localhost/fpl-cms/login.php


---

## Updated Files
| File | Purpose |
|------|---------|
| `login.php` | Login form + authentication |
| `logout.php` | Logout and destroy session |
| `index.php` | Now protected by login |
| `users` table | Stores hashed passwords |

---

## Status
Login system is working.  
Logout works.  
Access to the main page is protected.
