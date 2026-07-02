# DepEd Ligao City Division Finance Management Portal

> A centralized Finance Management Portal for the Schools Division Office (SDO) of Ligao City built with Laravel and Filament.

---

## Overview

The **DepEd Ligao City Division Finance Management Portal** serves as the primary digital gateway for finance-related services within the Schools Division Office of Ligao City.

The portal is designed to improve transparency, efficiency, and accessibility by providing personnel, school heads, and suppliers with a unified platform for monitoring procurement activities, budget utilization, financial allocations, and other finance-related services.

The system minimizes manual processes while promoting accountability through real-time dashboards, workflow automation, and role-based access control.

---

## Objectives

- Digitize finance-related processes
- Improve procurement tracking
- Provide budget monitoring and allocation metrics
- Promote financial transparency
- Centralize finance services in one portal
- Provide secure access based on user roles

---

## Features

### Procurement

- Procurement Tracking
- Purchase Request Monitoring
- Purchase Order Status
- Supplier Monitoring
- BAC Process Tracking

### Budget Management

- Budget Allocation Monitoring
- Fund Utilization Dashboard
- Budget Balances
- Budget History

### Financial Transparency

- Financial Reports
- Budget Utilization Reports
- Downloadable Documents
- Public Transparency Dashboard

### School Services

- School Budget Monitoring
- School Allocation Status
- Submitted Financial Documents
- Division Issuances

### User Management

- Role-Based Access Control
- Permission Management
- User Audit Logs
- Activity Monitoring

### Dashboard

- Financial Key Performance Indicators
- Budget Metrics
- Procurement Statistics
- Graphs and Analytics

---

## Technology Stack

| Technology | Version |
|------------|---------|
| PHP | 8.3+ |
| Laravel | 12.x |
| Laravel Filament | 4.x |
| Laravel Filament Shield | Latest |
| MySQL | 8+ |
| Tailwind CSS | Latest |
| Livewire | 3.x |

---

## Packages

- Laravel Framework
- Filament Admin Panel
- Filament Shield
- Laravel Permission
- Laravel Excel
- DomPDF
- Spatie Packages

---

## Installation

Clone the repository

```bash
git clone https://github.com/brianzaballa/sdo-ligao.git
```

Go to the project

```bash
cd sdo-ligao
```

Install dependencies

```bash
composer install
```

Copy environment file

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Configure your database inside `.env`

Run migrations

```bash
php artisan migrate
```

(Optional)

Seed the database

```bash
php artisan db:seed
```

Create storage link

```bash
php artisan storage:link
```

Start the server

```bash
php artisan serve
```

---

## Project Structure

```
app/
├── Filament/
├── Models/
├── Policies/
├── Providers/
├── Services/

database/
├── migrations/
├── seeders/

resources/
├── views/
├── css/
├── js/

routes/
storage/
```

---

## User Roles

- System Administrator
- Finance Officer
- Budget Officer
- Accountant
- BAC Secretariat
- School Head
- Supplier
- Viewer

---

## Security

The system implements:

- Authentication
- Role-Based Access Control (RBAC)
- Permission Management
- Audit Logs
- Activity Logging
- Secure File Storage
- CSRF Protection
- SQL Injection Protection

---

## Roadmap

- [*] Landing Page
- [*] User Authentication
- [*] Role-Based Access Control
- [ ] Settings Module
- [ ] Procurement Module
- [ ] Budget Allocation Module
- [ ] Financial Dashboard
- [ ] School Portal
- [ ] Supplier Portal
- [ ] Notification Center
- [ ] SMS Notifications
- [ ] Email Notifications
- [ ] Digital Signatures
- [ ] Document Management
- [ ] Financial Analytics
- [ ] Public Transparency Portal

---

## Contributing

Contributions, issues, and feature requests are welcome.

Please fork the repository and submit a Pull Request.

---

## License

This project is intended for internal use by the Schools Division Office of Ligao City.

---

## Developed By

**ICT Unit**
Schools Division Office of Ligao City

Department of Education
Republic of the Philippines

---

## Acknowledgements

- Laravel
- FilamentPHP
- Filament Shield
- Tailwind CSS
- Livewire
- Department of Education
