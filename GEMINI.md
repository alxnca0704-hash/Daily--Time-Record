# DENR Daily Time Record (DTR) System Prototype

A PHP-based web application designed for managing employee daily time records, departments, and generating reports. This project is currently in the prototype stage with mock functionality and basic UI structures.

## Project Overview

- **Purpose:** Provide a centralized system for tracking employee attendance and generating official DTR forms.
- **Tech Stack:** PHP (Backend), Vanilla CSS (Frontend), HTML5.
- **Architecture:** 
    - **Front Controller:** `index.php` handles routing based on the `page` GET parameter.
    - **UI Layer:** Located in the `ui/` directory, containing PHP files for different views.
    - **Logic Layer:** Located in the `logic/` directory, containing processing scripts for forms and data manipulation.
    - **Assets:** Static files (CSS, JS, images) are stored in the `assets/` directory.

## UI/UX Standards (Taste Skill)

The UI has been upgraded following the **Taste Skill** "Anti-Slop" principles:
- **Design Read:** Internal public-sector system with a trust-first, functional language.
- **Palette:** Professional Slate/Zinc neutral base with Emerald accents (representing DENR).
- **Typography:** Inter (Sans-serif) for high legibility and professional clarity.
- **Spacing:** Consistent 8px grid system with refined borders and subtle shadows.
- **Responsiveness:** Mobile-friendly grid layouts using `min-h-[100dvh]` and CSS Grid.

## Getting Started

### Prerequisites
- PHP 7.4 or higher.
- A local web server (XAMPP, WAMP, or the built-in PHP server).

### Running the Project
1. Clone the repository to your local machine.
2. If using the PHP built-in server, run the following command in the project root:
   ```bash
   php -S localhost:8000
   ```
3. Open your browser and navigate to `http://localhost:8000`.

## Development Conventions

- **File Naming:** Use kebab-case for filenames (e.g., `manage-employees.php`, `process-dtr.php`).
- **Routing:** New pages should be added to the `$allowed_pages` array in `index.php` and created within the `ui/` directory.
- **Styling:** Use the global variables defined in `assets/css/style.css` for consistent colors and spacing.
- **Form Handling:** Submit forms to scripts in the `logic/` directory.
- **Database (TODO):** Database integration is currently pending. The system is expected to use MySQL/MariaDB in the future.

## Key Directories
- `/assets`: Contains CSS and other static assets.
- `/logic`: Contains server-side processing scripts.
- `/ui`: Contains view templates/pages.
- `index.php`: The main entry point and router.
