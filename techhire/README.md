# Laravel Job Board Application

A robust, full-featured Job Board platform built with **Laravel 12**. This application connects Employers with Job Seekers, featuring role-based access control, job management, application tracking, and profile management.

## 🚀 Key Features

### 🔐 Authentication & Roles
* **Secure Authentication:** Powered by Laravel's native auth implementation.
* **Role-Based Access Control (RBAC):** Custom Middleware (`RoleMiddleware`) ensures security across three distinct roles:
    1.  **Admin:** System oversight (stats & metrics).
    2.  **Employer:** Post jobs, manage candidates.
    3.  **Job Seeker:** Search jobs, apply, track status.

### 💼 Employer Features
* **Job Management:** Create, Edit, and Delete job postings.
* **Applicant Tracking:** View list of applicants per job.
* **Application Management:** Review resumes and Accept/Reject applications directly from the dashboard.

### 🕵️ Job Seeker Features
* **Advanced Search:** Filter jobs by Title, Tech Stack, Job Type (Remote, Full-time), and Experience Level.
* **Profile Management:** Upload Resumes, manage portfolio links (GitHub/LinkedIn), and list skills.
* **Application History:** Track the status of all submitted applications (Pending, Accepted, Rejected).

### 📊 Dynamic Dashboards
* **Context-Aware UI:** The `DashboardController` automatically routes users to their specific interface (Admin, Employer, or Job Seeker) upon login.

---

## 🛠 Tech Stack

* **Framework:** Laravel 12.0
* **Language:** PHP ^8.2
* **Database:** SQLite
* **Frontend:** Blade Templates (Server-side rendering)

---

## 💾 Database Structure

The application uses a relational database with the following key schemas:

### `users`
* Stores authentication details and the `role` enum (`admin`, `employer`, `job_seeker`).

### `job_posts`
* Contains job details including `title`, `description`, `salary_range`.
* **Special Fields:**
    * `tech_stack`: Stored as a JSON array.
    * `status`: Enum (`active`, `inactive`, `closed`).
    * `job_type`: Enum (`full_time`, `remote`, etc.).

### `applications`
* Links `job_post_id` and `job_seeker_id`.
* Includes `cover_letter` and application `status` (`pending`, `accepted`, `rejected`).

### `job_seeker_profiles`
* Extended profile data including `resume_path`, `skills` (JSON), and social URLs.

---

## ⚙️ Installation

1.  **Clone the repository**
    ```bash
    git clone [https://github.com/yourusername/job-board.git](https://github.com/yourusername/job-board.git)
    cd job-board
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure your database credentials in the `.env` file.*

4.  **Database Migration**
    ```bash
    php artisan migrate
    ```

5.  **Link Storage** (Crucial for Resume uploads)
    ```bash
    php artisan storage:link
    ```

6.  **Run the Application**
    ```bash
    php artisan serve
    ```

---

## 🚦 Usage Guide

### Creating an Employer Account
1.  Register a new account and select **Employer** as the role.
    *(Note: Role selection is available on the registration form)*.
2.  Navigate to the Dashboard to "Post a New Job".
3.  Fill in the tech stack and requirements.

### Applying for a Job
1.  Register as a **Job Seeker**.
2.  Go to the Jobs page (`/jobs`).
3.  Click on a Job and submit your Cover Letter and Resume.

---

## 🛣 Routes Overview

| Method | URI | Description | Access |
| :--- | :--- | :--- | :--- |
| GET | `/` | Home Page | Public |
| GET | `/jobs` | List & Search Jobs | Public |
| GET | `/jobs/{job}` | View Job Details | Public |
| GET | `/dashboard` | User Dashboard | Protected |
| POST | `/jobs` | Create Job | Employer |
| POST | `/jobs/{job}/apply` | Apply for Job | Job Seeker |
| PATCH | `/applications/{id}/status` | Accept/Reject Applicant | Employer |

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).