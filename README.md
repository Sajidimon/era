<a href="https://era.envoydigitalbd.com"><img src="https://i.ibb.co.com/999dP6vw/era-funnel-builder.png" alt="era-funnel-builder" border="0" /></a>

---

```markdown
# era- Sales Funnel Builder

era- Sales Funnel Builder is an open source sales funnel builder designed and developed by **Imon Chowdhury** using **Laravel 11**, **Vue3**,
**Inertia.js**, and **Tailwind CSS**.
This project provides a powerful and intuitive platform for creating and managing sales funnels with a modern tech stack.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Development](#development)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgements](#acknowledgements)

## Features

- **Sales Funnel Creation:** Build, manage, and optimize your sales funnels effortlessly.
- **Drag-and-Drop Interface:** Design funnel pages using a user-friendly drag-and-drop editor.
- **User Authentication:** Secure registration, login, and password management.
- **Responsive Design:** Styled with Tailwind CSS for a modern, responsive look.
- **Seamless Integration:** Leverages Laravel’s robustness with Vue3’s reactivity and Inertia.js for smooth page transitions.
- **Customizable Components:** Easily extend or modify components to suit your business needs.

## Requirements

- **PHP** >= 8.1
- **Composer** for PHP dependency management
- **Node.js** (>= 16.x) and **npm** or **yarn** for frontend dependencies
- A database supported by Laravel (e.g., MySQL, PostgreSQL, SQLite)

## Installation

Follow these steps to set up the project locally:

1. **Clone the Repository**

   ```bash
   git clone https://github.com/sajidimon/era.git
   cd era
   ```

2. **Install PHP Dependencies**

   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**

   Using npm:

   ```bash
   npm install
   ```

   Or using yarn:

   ```bash
   yarn install
   ```

4. **Configure Environment Variables**

   Copy the example environment file and update the configuration:

   ```bash
   cp .env.example .env
   ```

   Edit the `.env` file to set your database credentials and other environment-specific settings.

5. **Generate the Application Key**

   ```bash
   php artisan key:generate
   ```

6. **Run Database Migrations**

   ```bash
   php artisan migrate
   ```

7. **Build Frontend Assets**

   For development:

   ```bash
   npm run dev
   ```

   For production:

   ```bash
   npm run build
   ```

8. **Serve the Application**

   Start the Laravel development server:

   ```bash
   php artisan serve
   ```

   The application should now be accessible at [http://localhost:8000](http://localhost:8000).

## Configuration

- **.env File:** Ensure that you update your database, mail, and other service configurations.
- **Tailwind CSS:** Modify `tailwind.config.js` to customize your design as needed.
- **Vue3 & Inertia.js:** Customize your Vue components located in the `resources/js` directory to enhance or extend functionality.

## Usage

- **Creating Funnels:** Use the intuitive drag-and-drop interface to design and deploy your sales funnels.
- **Managing Funnels:** Access the dashboard to monitor, edit, and optimize your funnels.
- **Customization:** Modify routes, controllers, and Vue components to tailor the platform to your requirements.

## Development

For local development, consider the following tips:

- **Hot Reloading:** Use `npm run dev` for hot reloading of frontend assets.
- **Testing:** Run tests using Laravel’s built-in testing tools:
  
  ```bash
  php artisan test
  ```
- **Coding Standards:** Follow Laravel’s coding standards and best practices for PHP and JavaScript.

## Contributing

Contributions are welcome! To contribute:

1. Fork the repository.
2. Create a new branch for your feature or bug fix:

   ```bash
   git checkout -b feature/your-feature-name
   ```

3. Commit your changes:

   ```bash
   git commit -m "Add: description of changes"
   ```

4. Push to your branch:

   ```bash
   git push origin feature/your-feature-name
   ```

5. Open a pull request detailing your changes.

For detailed guidelines, please refer to [CONTRIBUTING.md](CONTRIBUTING.md).

## License

This project is licensed under the [MIT License](LICENSE). You are free to use and modify the code as per the license terms.

## Acknowledgements

- **Imon Chowdhury** – For designing and developing era- Sales Funnel Builder.
- Thanks to the Laravel, Vue3, Inertia.js, and Tailwind CSS communities for their continued support and development of these excellent tools.

---

Happy building and optimizing your sales funnels with era- Sales Funnel Builder!
