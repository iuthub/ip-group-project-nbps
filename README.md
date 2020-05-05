# Internet Programming: Group Project Assignment

Find `ip_group_project.pdf` file in this folder, and refer to all the instructions given there.

You have to submit your project into this repository before 10.05.2019 (midnight).

## Group members

---

1. Shoumarov Bositkhon - U1810170
2. Umarbekov Kobikbel - U1810182
3. Mansurov Jonibek - U1810266
4. Sim Aleksanrd - U1810270
5. Sapaev Shukurillo - U1810155
6. Djanibekov Amirbek - U1810281

## Installation

---

1. Clone the repository in your local machine
2. Enter backend directory

```
cd backend
```

3. Run composer installation

```
composer install
```

4. Copy contents of file .env.example to .env
5. Set up database settings in the .env file
6. If you want to simply migrate execute command

```
php artisan migrate
```

7. If you want to migrate and seed execute command

```
php artisan migrate --seed
```

8. Generate key for the project by running command

```
php artisan key:generate
```

9. Finally to host it on your local machine execute

```
php artisan serve
```

10. Access the website by going to the link <http://localhost:8000>

## Try out the demo version online

---

[Demo version (admin panel)](https://herokuapp.com)

[Demo version (front)](https://herokuapp.com)

## REST API Endpoints

| Authorized? | Method | Endpoint                                        | Arguments                                                                               | Description                             |
| ----------- | ------ | ----------------------------------------------- | --------------------------------------------------------------------------------------- | --------------------------------------- |
| _no_        | POST   | `http://{domain}/api/login`                     | **email, password**                                                                     | Login                                   |
| _no_        | POST   | `http://{domain}/api/signup`                    | **name, email, password, password_confirmation, firstname, lastname**,                  | Signup                                  |
| _yes_       | POST   | `http://{domain}/api/refresh`                   |                                                                                         | Refresh token                           |
| _yes_       | POST   | `http://{domain}/api/logout`                    |                                                                                         | Logout                                  |
| _no_        | GET    | `http://{domain}/api/categories`                |                                                                                         | List all categories                     |
| _no_        | GET    | `http://{domain}/api/category/{category}`       |                                                                                         | Show category by ID                     |
| _no_        | GET    | `http://{domain}/api/category/{category}/items` |                                                                                         | Show items by category ID               |
| _no_        | GET    | `http://{domain}/api/tables`                    |                                                                                         | List all tables                         |
| _yes_       | GET    | `http://{domain}/api/table{category}/details`   |                                                                                         | Show bookings of table by ID            |
| _yes_       | GET    | `http://{domain}/api/account`                   |                                                                                         | Show account details                    |
| _yes_       | PATCH  | `http://{domain}/api/account`                   | **name, email, password, firstname, lastname, phone, country, city, postcode, address** | Update account details                  |
| _yes_       | GET    | `http://{domain}/api/orders`                    |                                                                                         | Show orders of an authenticated user    |
| _yes_       | GET    | `http://{domain}/api/order/{order}`             |                                                                                         | Show order details                      |
| _yes_       | POST   | `http://{domain}/api/order`                     | **payment_type (card, cash), items (array)**                                            | Place an order                          |
| _yes_       | GET    | `http://{domain}/api/bookings`                  |                                                                                         | Lost all bookings by authenticated user |
| _yes_       | POST   | `http://{domain}/api/book/table/{table}`        |                                                                                         | Book a table by ID                      |

### All routes requiring authorization accepts Bearer Token passed by header parameter

```
Authorization: Bearer <token>
```
