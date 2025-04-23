# Optical Clinic Management System

A comprehensive web application for managing an optical clinic, built with Laravel and modern frontend technologies.

## Features

- **Patient Management**
  - Add, edit, and view patient records
  - Store patient details: name, gender, insurance, blood type, DOB, job, address, contact number, diagnosis, and more
- **Appointment Scheduling**
  - Create, edit, and manage appointments
  - Modal-based appointment creation and editing
  - Track appointment status (Done/Not Done)
  - Add appointment notes and payment details
- **Prescription Handling**
  - Record and display prescription details (Sphere, Cylinder, Axis for both eyes, Distant/Near, PD)
- **Payment Management**
  - Record payment type (cash, gift, free, other) and currency (LBP, USD)
  - Track payment status and history
- **Localization & Translation**
  - Multi-language support (including RTL for Arabic)
  - Integrated translation manager for easy language file management
- **User Interface**
  - Responsive design using Bootstrap
  - Dynamic forms with validation and error handling
  - Uses Livewire for reactive components
- **Notifications**
  - Toastr notifications for user feedback
- **Other Features**
  - Self-update notification system
  - Integration with Laravel's artisan GUI for command management

## Tech Stack

- **Backend:** Laravel PHP Framework
- **Frontend:** Blade, Bootstrap, Livewire, jQuery, Alpine.js
- **JS Libraries:** React, Vue (for specific components), Toastr, Datepicker, Timepicker
- **Build Tools:** Laravel Mix, TailwindCSS, Sass

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/opticalClinic.git
   ```
2. Navigate to the project folder:
   ```sh
   cd opticalClinic-react
   ```
3. Install dependencies:
   ```sh
   npm install
   ```
4. Start the development server:
   ```sh
   npm start
   ```

## Technologies Used
- **Frontend**: React, MUI (Material-UI) for UI components
- **Backend**: Laravel (for API endpoints)
- **Database**: MySQL
- **State Management**: Redux
- **Authentication**: JWT

## Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your changes.

## License
This project is licensed under the MIT License.

