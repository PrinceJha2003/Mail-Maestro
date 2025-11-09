📧 Mail Maestro – Smart  Email  Scheduler  & 
 Automation Tool

Mail Maestro is a Laravel-based web application that streamlines the process of managing, sending, and tracking emails efficiently.
It’s built for organizations that need a centralized platform to handle internal and external email communication securely and efficiently.

🚀 Features

📩 Compose & Send Emails – Send emails directly from the system.

🗃️ Inbox & Sent Items – View and manage all incoming and outgoing emails.

👥 User Authentication – Secure login and role-based access using Laravel Breeze / Jetstream.

📨 Email Templates – Create and reuse professional email templates.

📊 Dashboard Analytics – Get insights into email activity and usage.

🔔 Notifications – Real-time alerts for new messages or system updates.

🛡️ Security – Built with Laravel’s CSRF protection and authentication middleware.

🧰 Tech Stack

Framework: Laravel 10

Frontend: Blade / Bootstrap / Tailwind CSS

Database: MySQL

Server: Apache (XAMPP / Laravel Sail)

Version Control: Git & GitHub

⚙️ Installation & Setup

Clone the repository

git clone https://github.com/PrinceJha2003/Mail-Maestro.git
cd Mail-Maestro


Install dependencies

composer install
npm install


Create .env file

cp .env.example .env
php artisan key:generate


Configure environment

Set up your database credentials in .env

Configure mail settings:

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"


Run migrations

php artisan migrate


Start the development server

php artisan serve


Visit: http://localhost:8000

📦 Project Structure
Mail-Maestro/
├── app/
├── bootstrap/
├── config/
├── public/
├── resources/
│   ├── views/
│   └── css/
├── routes/
│   └── web.php
└── .env.example

👨‍💻 Author

Prince Jha
📍 Delhi, India
