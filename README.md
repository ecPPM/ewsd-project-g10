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
9. Serve the Application
   ```sh
   php artisan serve
   ```

### Subsequently running the app

Developers will let you know if there is any update in .env file.

Please make changes according to them.

The application will start with this command
```sh
   php artisan serve
```
