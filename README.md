Steps to run the project:
1) clone the repository using command : ``` git clone https://github.com/rk9930/student-report-system.git ```

2) create a .env file and copy all the values from .env.example into .env in root directory of the project

3) create a database name as student_system for testing the inbox mail

4) login to [mailtrap.com](https://mailtrap.io/signin) and get username and password
   ![image](https://github.com/rk9930/student-report-system/assets/79439746/7085d808-5ad5-468d-beaa-c0b7cdaf3e60)

5) use username and password at : ```MAIL_USERNAME=
MAIL_PASSWORD= ``` inside .env file

6) run the below commands :
   ```
   php artisan key:generate
   php artisan migrate
   php artisan serve
   ```
7) visit the path http://127.0.0.1:8000 for homepage of the project

