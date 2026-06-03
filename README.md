# DENR Daily Time Record (DTR) System Prototype

A sophisticated, high-performance PHP-based web application prototype designed for managing personnel attendance and department schedules for the Department of Environment and Natural Resources (DENR).

![System Logo](assets/Images/denr.png)

## ✨ Features

-   **Modern Sidebar Navigation:** Professional dashboard layout with a sticky sidebar and Phosphor Icons for streamlined workflow.
-   **Minimalist UI/UX:** A "Linear-style" high-contrast design using pure white backgrounds, shadowed cards, and bold black accents.
-   **Advanced Pickers:**
    -   **Inline Date Range Picker:** Permanent visual calendar for report generation.
    -   **Pure Selection Time Pickers:** Custom-built dropdown-based time selection (no numeric entry required).
    -   **Combined Datetime Picker:** Integrated selection for manual attendance adjustments.
-   **Productive Dashboard:** Data-rich overview with live counters for employees, departments, and logs.
-   **Full CRUD Management:** Complete Create, Read, Update, and Delete capabilities for both Employees and Departments.
-   **Premium Typography:** Self-hosted **Plus Jakarta Sans** font family for a refined, modern look.
-   **Micro-Feedback System:** Real-time toast notifications and interactive loading states for immediate user confirmation.
-   **Temporary Session Storage:** Fully functional testing environment using PHP sessions (no database configuration required for prototyping).

## 🛠️ Technical Stack

-   **Backend:** PHP 7.4+
-   **Frontend:** Vanilla CSS, HTML5
-   **Icons:** Phosphor Icons (Bold Set)
-   **Date Library:** Flatpickr (Inline/Range modes)
-   **Fonts:** Plus Jakarta Sans (Self-hosted)
-   **Architecture:** Front Controller Pattern (`index.php`)

## 🚀 Getting Started

### Prerequisites
- PHP 7.4 or higher installed on your machine.
- A local web server (XAMPP, WAMP) or the built-in PHP server.

### Installation
1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/your-repo/Daily--Time-Record.git
    cd Daily--Time-Record
    ```
2.  **Start the Server:**
    If using the PHP built-in server:
    ```bash
    php -S localhost:8000
    ```
3.  **Access the App:**
    Open your browser and navigate to `http://localhost:8000`.

## 📁 Project Structure

-   `/assets`: Static assets including CSS, custom fonts, and images.
-   `/logic`: Server-side PHP scripts for data processing and session management.
-   `/ui`: View templates for different application screens.
-   `index.php`: Main router and layout wrapper.
-   `.gitignore`: Pre-configured to protect sensitive files and agent data.

## 📝 Development Notes

-   **Styling:** Follows the "Anti-Slop" principles of the **Taste Skill** framework.
-   **Conventions:** Uses kebab-case for filenames and high-legibility typographic hierarchy.
-   **Storage:** Currently uses `$_SESSION` for prototyping. Database integration (MySQL/MariaDB) is the next logical step for production.

---
*Created as part of the DENR DTR System Digitization Prototype.*
