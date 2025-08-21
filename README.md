#  Laravel CRUD School Project

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red?logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1-blue?logo=php)](https://www.php.net)
[![Database](https://img.shields.io/badge/Database-MySQL-informational?logo=mysql)]()
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)
[![GitHub stars](https://img.shields.io/github/stars/Ipangbbd/Laravel-CRUD?style=social)](https://github.com/Ipangbbd/Laravel-CRUD/stargazers)

A simple **Laravel-based CRUD application** to manage data with clean MVC structure and intuitive UI, built as a school project.

---

##  Main Features

-  **CRUD Operations** – Create, Read, Update, Delete records seamlessly  
-  **Blade Templating** – Dynamic views with Laravel’s Blade engine  
-  **Migrations & Seeder** – Easy setup and database seeding  
-  **Validation** – Secure and consistent form handling  
-  **Modular MVC Structure** – Clean `app/`, `routes/`, and `resources/`, easy to extend  

---

##  Tech Stack

- [Laravel](https://laravel.com) – PHP framework (MVC, Blade, Eloquent)  
- [PHP](https://www.php.net) – Language runtime  
- [MySQL](https://www.mysql.com) – Database backend  
- [Composer](https://getcomposer.org) – Dependency management  

---

##  Project Structure

```

Laravel-CRUD/
├── app/               # Controllers, Models
├── database/
│   ├── migrations/    # Schema migrations
│   └── seeders/       # Seed data
├── public/            # Public entrypoint (index.php)
├── resources/
│   ├── views/         # Blade templates
│   └── css/js/ assets
├── routes/
│   └── web.php        # Route definitions
├── .env.example       # Sample config for env
├── composer.json      # PHP dependencies
└── README.md          # Project documentation

````

---

##  Installation & Setup

1. Clone the repo:  
   ```bash
   git clone https://github.com/Ipangbbd/Laravel-CRUD.git
   cd Laravel-CRUD
````

2. Install Composer dependencies:

   ```bash
   composer install
   ```
3. Setup environment:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Configure database credentials in `.env` file.
5. Run migrations and seeders:

   ```bash
   php artisan migrate --seed
   ```
6. Launch the app:

   ```bash
   php artisan serve
   ```
7. Access via `http://127.0.0.1:8000`

---

## Roadmap (Next Steps)

* [ ] &#x20;Add user authentication (login/register)
* [ ] &#x20;Role-based access (admin vs user)
* [ ] &#x20;API endpoints with JSON responses
* [ ] &#x20;Frontend enhancements with Tailwind CSS or Vue.js
* [ ] &#x20;Dockerize for consistent deployment workflows

---

## Contributing

Contributions are welcome! Please:

1. Fork the repository
2. Create a branch: `git checkout -b feat/awesome-feature`
3. Commit your changes: `git commit -m "feat: awesome feature"`
4. Push to your fork and open a Pull Request

---

## License

Released under the **MIT License** – see the [LICENSE](LICENSE) file for details.

---

## Support & Feedback

If you find this project useful or have suggestions, feel free to give it a ⭐ on GitHub or open an issue — would love to hear from you!
