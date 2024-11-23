# README

## Project Title: Laravel Employee Management System

This project is a simple **Laravel-based Pegawai Management System** with CRUD functionalities. It consists of four main views for managing employee data. The system is built using **Laravel Framework 11.33.2**, with data managed through MySQL. The project utilizes **Eloquent ORM**, **AJAX**, and **jQuery Validator** for efficient and dynamic user interaction.

---

## Features

1. **View Employee List**
   - Display a list of employees using **REST API** and **AJAX**.
   - Features include sorting and filtering data by any desired column.
   - The data is fetched dynamically and displayed in a responsive DataTable.
     ![image](https://github.com/user-attachments/assets/96418763-fbee-4b4c-a9f9-c93a7bea4889)


2. **Add Employee**
   - A form to add new employee data with the following fields:
     - Name
     - Email (validated to ensure uniqueness via AJAX check to the database).
     - Upload photo (image files only).
     - Upload document (PDF only).
   - Utilizes **jQuery Validator** for client-side form validation.
     ![image](https://github.com/user-attachments/assets/33ff1b50-cab2-49b1-a474-c92aff764839)


3. **View Employee Details**
   - Displays detailed information about a specific employee, including:
     - Photo
     - Uploaded documents
     - Other personal details.
   - Includes an option to edit or delete the employee record.
     ![image](https://github.com/user-attachments/assets/42629372-22bc-485f-852e-9b5f5fece727)


4. **Edit Employee**
   - Allows editing the data of an employee, including re-uploading their photo and documents.
     ![image](https://github.com/user-attachments/assets/a72c9f9d-8808-416a-b4d6-43a91d7f73db)


5. **Delete Employee**
   - Removes an employee record from the database along with their associated uploaded files (photo and document).

---

## Technologies Used

### Backend
- **Laravel Framework**: Handles routing, business logic, and database management.
- **Eloquent ORM**: Provides an object-oriented way to interact with the database.
- **REST API**: Enables data fetching for the employee list view.

### Frontend
- **Bootstrap**: For responsive and user-friendly UI.
- **jQuery and AJAX**: For dynamic data updates without page reloads.
- **DataTables**: For advanced table functionalities like sorting and filtering.
- **jQuery Validator**: To validate form inputs before submission.

---

## Installation

### Prerequisites
- PHP (>=8.0)
- Composer
- MySQL or any other database supported by Laravel
- Node.js and npm (optional, for frontend dependency management)

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/arvindaffa/mini-project-fullstack.git
   cd mini-project-fullstack
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure the `.env` file:
   - Update the database connection settings:
     ```
     DB_CONNECTION=mysql
     DB_DATABASE=pegawai
     ```

4. Run migrations to make a table
   ```bash
   php artisan migrate
   ```
   
5. Run the  seeders to create and populate the `data_pegawai` table:
   ```bash
   php artisan db:seed --class=PegawaiSeeder
   ```

6. Serve the application:
   ```bash
   php artisan serve
   ```

---

## Database Structure

The database consists of a single table named `data_pegawai` with the following columns:
- `id`: Primary key.
- `nama`: Employee's full name.
- `email`: Employee's email (unique).
- `departemen`: Employee's department.
- `umur`: Employee's age.
- `jenis_kelamin`: Employee's gender.
- `tanggal_masuk`: Date of joining.
- `foto`: Path to the uploaded photo.
- `cv`: Path to the uploaded document.
- `created_at` and `updated_at`: Timestamps.

---

## How It Works

1. **List Employee Data**
   - The `pegawai` view fetches employee data from the `data_pegawai` table via an API route.
   - AJAX dynamically updates the table with sorting and filtering options.

2. **Add Employee**
   - The `tambahpegawai` view includes a form validated with jQuery Validator.
   - AJAX is used to check the uniqueness of the email before submission.
   - Photo and document uploads are handled using Laravel's `Storage` facade.

3. **View Details**
   - The `detailpegawai` view displays all details of an employee.
   - Photo and documents are retrieved dynamically and displayed.

4. **Edit Employee**
   - The `editpegawai` view provides a pre-filled form with the employee's current data.
   - Users can update fields and re-upload files.

5. **Delete Employee**
   - The `hapuspegawai` function deletes the employee record and associated files.

---

## API Endpoints

1. **GET /api/pegawai**
   - Fetches the list of all employees in JSON format.

2. **POST /cek-email**
   - Checks if an email exists in the database for validation during the addition or editing of an employee.

---

## File Uploads

- Employee photos and documents are stored in the `storage/app/public/uploads` directory.
- Use the following command to create a symbolic link to access these files publicly:
  ```bash
  php artisan storage:link
  ```

---

## Key Libraries and Dependencies

- **Laravel**: Framework for backend logic.
- **DataTables**: Frontend table management.
- **Dropzone.js**: File uploads.
- **Select2**: Dropdown and Selection.
- **Bootstrap**: Responsive design.
- **Faker**: For seeding the database with dummy data.
- **jQuery Validator**: For form validation.

---

## Future Enhancements
You can:
- Add API Endpoint for Create, Update, and Delete.
- Add more table to make a relation e.g. Salary_Table
- Add user authentication for restricted access.
- Implement role-based access control for admin and user roles.
- Include advanced reporting features for employee data.

---

Enjoy building with Laravel! 🚀
