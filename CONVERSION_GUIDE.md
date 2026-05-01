# Food Ordering System - Laravel Conversion

This is a complete conversion of the PHP Food Ordering System into a modern Laravel application.

## Conversion Summary

The original PHP project has been successfully converted to Laravel with the following improvements:

### ✅ What Was Converted:
- **Database Schema**: All 8 tables converted to Laravel migrations
- **User Authentication**: Registration, login, and logout with role-based access
- **Models & Relationships**: Eloquent ORM with proper relationships
- **Controllers**: 6 controllers handling all business logic
- **Routing**: RESTful API-style routes with middleware protection
- **Blade Templates**: View files with modern UI using Materialize CSS
- **Database Seeding**: Sample data loader for quick testing

### 📁 Project Structure

```
food-ordering-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── OrderController.php
│   │   │   ├── MenuController.php
│   │   │   ├── WalletController.php
│   │   │   ├── TicketController.php
│   │   │   └── AdminController.php
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Item.php
│   │   ├── Order.php
│   │   ├── OrderDetail.php
│   │   ├── Ticket.php
│   │   ├── TicketDetail.php
│   │   ├── Wallet.php
│   │   └── WalletDetail.php
├── database/
│   ├── migrations/
│   │   ├── [tables for all 8 database tables]
│   ├── seeders/
│   │   └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── auth/ (login, register)
│   │   ├── customer/ (dashboard)
│   │   ├── menu/ (browse items)
│   │   ├── orders/ (place, view orders)
│   │   ├── wallet/ (wallet management)
│   │   ├── tickets/ (support tickets)
│   │   └── admin/ (admin dashboard)
├── routes/
│   └── web.php (all routes defined)
└── config/ (Laravel configuration)
```

## Features Implemented

### Customer Features:
- ✅ User Registration & Login
- ✅ Browse Menu Items
- ✅ Place Orders
- ✅ View Order History & Details
- ✅ Manage Wallet & Balance
- ✅ Support Tickets System
- ✅ Order Cancellation

### Admin Features:
- ✅ Admin Dashboard with Statistics
- ✅ Manage Items (Create, Edit, Delete)
- ✅ View All Orders & Update Status
- ✅ Manage Users & Verify Accounts
- ✅ View & Respond to Support Tickets
- ✅ Revenue Tracking

## Installation & Setup

### Prerequisites:
- PHP 8.1 or higher
- Composer
- MySQL/MariaDB
- Node.js & NPM (optional, for asset compilation)

### Step 1: Install Dependencies
```bash
cd food-ordering-laravel
composer install
```

### Step 2: Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=food_ordering
DB_USERNAME=root
DB_PASSWORD=
```

### Step 3: Create Database
```bash
# Create the database
mysql -u root -p -e "CREATE DATABASE food_ordering;"
```

### Step 4: Run Migrations & Seed
```bash
# Run migrations
php artisan migrate

# Seed sample data
php artisan db:seed
```

### Step 5: Start the Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Test Credentials

After running seeders, use these credentials to test:

### Admin Account:
- **Username:** root
- **Password:** toor

### Customer Accounts:
- **Username:** user1 | **Password:** pass1
- **Username:** user2 | **Password:** pass2
- **Username:** user3 | **Password:** pass3

## Database Tables

The following tables are created by migrations:

1. **users** - User accounts (Admin/Customer)
2. **items** - Menu items
3. **orders** - Customer orders
4. **order_details** - Item details for each order
5. **tickets** - Support tickets
6. **ticket_details** - Ticket messages/replies
7. **wallets** - Wallet accounts
8. **wallet_details** - Credit card & balance info
9. **password_reset_tokens** - Laravel password reset
10. **sessions** - Laravel session management

## Key Improvements Over Original PHP

| Feature | Original PHP | Laravel Version |
|---------|-------------|-----------------|
| Framework | Procedural PHP | Modern Laravel |
| Database | Raw MySQLi | Eloquent ORM |
| Routing | File-based | Centralized routes/web.php |
| Templates | PHP Templating | Blade Templating |
| Authentication | Session-based | Laravel Auth |
| Validation | Manual | Laravel Validator |
| Relationships | Manual Queries | Eloquent Relationships |
| Migrations | SQL files | Code-based |
| Middleware | Not present | Role-based protection |
| Error Handling | Basic | Comprehensive |

## API Routes

### Public Routes:
- `GET /` - Home redirect
- `GET /login` - Login form
- `POST /login` - Submit login
- `GET /register` - Register form
- `POST /register` - Submit registration

### Customer Routes (Authenticated):
- `GET /dashboard` - Customer dashboard
- `GET /menu` - Browse menu items
- `GET /menu/{id}` - View item details
- `GET /orders` - View orders list
- `POST /orders` - Place new order
- `GET /orders/{id}` - View order details
- `POST /orders/{id}/cancel` - Cancel order
- `GET /wallet` - View wallet
- `POST /wallet/add-balance` - Add balance
- `GET /tickets` - View support tickets
- `POST /tickets` - Create ticket
- `GET /tickets/{id}` - View ticket details

### Admin Routes (/admin prefix):
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/orders` - Manage orders
- `POST /admin/orders/{id}/status` - Update order status
- `GET /admin/items` - Manage menu items
- `POST /admin/items` - Create item
- `PUT /admin/items/{id}` - Update item
- `DELETE /admin/items/{id}` - Delete item
- `GET /admin/users` - Manage users
- `GET /admin/users/{id}` - View user details
- `POST /admin/users/{id}/verify` - Verify user
- `GET /admin/tickets` - View all tickets

## Next Steps for Development

1. **Authentication Enhancement**: 
   - Hash passwords properly using `Hash::make()`
   - Implement "Remember Me" functionality
   - Add password reset via email

2. **Payment Gateway Integration**:
   - Integrate real payment systems (Stripe, PayPal)
   - Remove fake credit card system

3. **Email Notifications**:
   - Send email on order placement
   - Send email notifications for ticket updates
   - Order status change notifications

4. **Frontend Design**:
   - Create custom CSS to replace Materialize
   - Add food item images/photos
   - Improve mobile responsiveness

5. **Admin Features**:
   - Add sales reports and analytics
   - Implement inventory management
   - Add restaurant timing/working hours

6. **Performance Optimization**:
   - Add caching for menu items
   - Implement pagination optimizations
   - Add search functionality

7. **Testing**:
   - Unit tests for models
   - Feature tests for controllers
   - Integration tests

8. **Deployment**:
   - Configure for production server
   - Set up SSL certificates
   - Configure email service (SendGrid, AWS SES, etc.)

## Troubleshooting

### Database Connection Error:
```bash
# Check MySQL is running
# Update .env with correct credentials
# Run: php artisan migrate:refresh --seed
```

### Migrate Error:
```bash
# Fresh installation
php artisan migrate:fresh --seed
```

### Clear Cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## File Conversions Mapping

| Original PHP File | Laravel Equivalent |
|------|-------------|
| includes/connect.php | config/database.php |
| login.php | AuthController::showLoginForm() |
| register.php | AuthController::showRegisterForm() |
| index.php | routes/web.php + controllers |
| orders.php | OrderController |
| place-order.php | OrderController::create() |
| wallet.php | WalletController |
| tickets.php | TicketController |
| admin-page.php | AdminController |
| routers/*.php | routes/web.php |

## Version Information

- **PHP:** 8.1+
- **Laravel:** 11.x
- **MySQL:** 5.7+
- **Composer:** Latest
- **Node:** 18.x (for frontend assets)

## License

This project is converted from the original Food Ordering System project for educational purposes.

## Support

For issues or questions, check the Laravel documentation:
- Laravel Docs: https://laravel.com/docs
- Eloquent ORM: https://laravel.com/docs/eloquent
- Blade Templating: https://laravel.com/docs/blade

---

**Conversion Completed Successfully! 🎉**

Your Laravel Food Ordering System is ready for development and deployment.
