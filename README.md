# Capstone-2 Project

Web application for applying for internal scholarships with case studies at the Faculty of Information Technology, Maranatha Christian University. There are 4 user roles in this application: administrator, student, study program user (study program head), and faculty user (dean, deputy dean). The following outlines the capabilities of each user role.

## Authors
* [Kevin Owen](https://github.com/kvinown)
* [Joseph Adiwiguna](https://github.com/JosephAdiwiguna1)
* [Cherno Salwa Joviansyah](https://github.com/ITJov)

## Technology Components
* **Laravel Framework:** v11.8.0
* **Node.js:** v20.10.0
* **Bootstrap:** v5.3.3
* **NPM:** v10.2.3
* **MySQL:** v8.0

## User Roles and Capabilities

### 1. Administrator
- Manage users and roles
- Oversee application settings
- Monitor system performance and logs

### 2. Student
- Apply for scholarships
- View application status
- Update personal information

### 3. Study Program User (Study Program Head)
- Review student applications
- Approve or reject applications
- Provide feedback to students

### 4. Faculty User (Dean, Deputy Dean)
- Final approval of scholarship applications
- Generate reports on scholarship distribution
- Manage faculty-specific settings

## Installation and Setup

### Prerequisites
- [Node.js v20.10.0](https://nodejs.org/)
- [NPM v10.2.3](https://www.npmjs.com/)
- [MySQL v8.0](https://www.mysql.com/)
- [Composer](https://getcomposer.org/) (for Laravel)

### Steps

1. **Clone the repository**
    ```sh
    git clone https://github.com/your-repo/capstone-2.git
    cd capstone-2
    ```

2. **Install Laravel dependencies**
    ```sh
    composer install
    ```

3. **Install Node.js dependencies**
    ```sh
    npm install
    ```

4. **Setup environment variables**
    ```sh
    cp .env.example .env
    ```
   Edit the `.env` file with your database and other configurations.

5. **Generate application key**
    ```sh
    php artisan key:generate
    ```

6. **Run database migrations**
    ```sh
    php artisan migrate
    ```

7. **Start the development server**
    ```sh
    php artisan serve
    ```

8. **Compile assets**
    ```sh
    npm run dev
    ```

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
****