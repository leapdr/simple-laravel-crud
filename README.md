# Simple

This is a simple CMS laravel project built with basic authentication using **Sanctum** and products page using [**Vue.js**](https://vuejs.org/m) and **Laravel API**. The template used was [AdminLTE](https://adminlte.io/), an open source and easy to use admin dasboard.

## Installation

1. Clone Repository

    `git clone https://github.com/leapdr/simple-laravel-crud.git`

2. Run migration

    `php artisan migrate`

3. Create `.env`

    `cp .env.example .env`

    This would also copy the default superadmin user needed for db seeding.

4. Run seeder

    `php artisan db:seed`

    *Note that there are other default amdmins that can be edited before seeding. This is located at the `config/admin`*

## Built With

- PHP ([Laravel](https://laravel.com/), Carbon, Santum)
- JavaScript ([VueJS](https://vuejs.org/), jQuery)
- Blade (templating)
- HTML
- CSS
- [AdminLTE](https://adminlte.io/)
- [Summernote](https://summernote.org/)
- [vuejs-datetimepicker](https://www.npmjs.com/package/vuejs-datetimepicker)

## Screenshots

**Login**
![Login](/screenshots/login.jpg "Log in")

**Products**
![Products](/screenshots/products.jpg "Products")

**Create Product**
![Create Product](/screenshots/create-product.jpg "Create Product")

## 🤝 Support

Contributions, issues, and feature requests are welcome!

Give a ⭐️ if you like this project!

---
***Aaron S. Basco***
<br />
*[Profile](https://github.com/rohit19060 "Rohit jain")* |
*[Email](mailto:aron42610@hotmail.com?subject=Hi% "Hi!")* |
*[LinkedIn](https://www.linkedin.com/in/aaron-basco-114326118/)*
