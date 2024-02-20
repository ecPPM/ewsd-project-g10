<!-- GETTING STARTED -->
## Getting Started

Hello everyone! 
To set up our EWSD project locally, follow the steps below in order.

We will be using **PHP version 8.1** and **laravel 10** for our project.

### Prerequisites

1. XAMPP
   
Install the XAMPP web server on your computer using link : https://www.apachefriends.org/download.html

**Make sure to download XAMPP with PHP version 8.1**

Start XAMPP's apache and mysql services by opening the XAMPP control panel.

2. npm
   
To check if npm is installed on your system, run the following command in your terminal:
   ```sh
   npm -v
   ```
If npm is installed, you will see a version number. If npm is not installed, you will see an error message.

If npm is not installed, install Node.js from the Node.js website.

After installing Node.js, verify that npm is installed correctly by running npm -v in your terminal.

---

### First Time Installation

1. Clone the Repository   _(Here, **.** referts to current directory)_
   ```sh
   git clone https://github.com/ecPPM/ewsd-project-g10.git .
   ```
2. Install Composer Dependencies   _(Might need VPN for some packages)_
   ```sh
   composer install
   ```
3. Copy the Environment File
   ```sh
   cp .env.example .env
   ```
4. Generate an Application Key
   ```sh
   php artisan key:generate
   ```
5. Create a Symbolic Link for Storage
   ```sh
   php artisan storage:link
   ```
6. Run Migrations
   ```sh
   php artisan migrate
   ```
7. Install NPM Dependencies
   ```sh
   npm install
   ```
8. Compile Assets
   ```sh
   npm run dev
   ```
9. Seed dummy data for the Application
   ```sh
   php artisan db:seed
   ```
   This will fill sample data in "roles" and "users" tables
   
10. Serve the Application
       ```sh
       php artisan serve
       ```

You can now login with email "admin@gmail.com" and password "password" for admin account.

For student and tutor accounts, open phpMyAdmin on localhost and take a look at the "users" table.

Role id of "2" is tutor and "3" is student.

---

### Subsequently running the app

For the next times, you can follow the steps below in order to run the application.

1. Get the latest code from github
   ```sh
   git pull
   ```
2. [Only needed when there are changes in configuration] Copy .env
   ```sh
   cp .env.example .env
   ```

   [Run this only when _cp .env.example .env_ command was run] Generate the application key again
   ```sh
   php artisan key:generate
   ```

3. [Only needed when there are new npm dependencies installed] Install NPM Dependencies
   ```sh
   npm install
   ```

   [Run this only when _npm install_ command was run] Compile Assets
   ```sh
   npm run dev
   ```
   
4. [Only needed when there are changes in database schema] Update migrations
   ```sh
   php artisan migrate
   ```
5. Serve the Application
   ```sh
   php artisan serve
   ```
