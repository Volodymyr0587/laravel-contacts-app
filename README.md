# Contact Management Application

#### This application is inspired by Google Contacts and allows users to manage their contacts with powerful features like categorization, filtering, and search. Each contact can have multiple phone numbers, emails, addresses, and labels for easy organization.

## Features

**User Authentication:** Users can register and log in to manage their own contact list.

**Contact Management:** Create, edit, and delete contacts with details such as phone numbers, emails, addresses, and custom labels.

**Birthday Tracking:** Add a birthday to contacts, with an indicator for upcoming birthdays. Tooltips and icons highlight contacts with birthdays in the upcoming week.

**Category Management:** Organize contacts into categories that are unique per user.

**Favorite Contacts:** Mark contacts as favorites to keep them at the top of the list.

**Filtering and Sorting:** Sort contacts by name, and filter by categories or favorite status.

**Search:** Search contacts by name, phone number, or email for quick access.

**Pagination:** Contacts are paginated for easier browsing.

**Soft Delete & Restore:** Contacts can be soft deleted and restored, with options for permanent deletion.

**CSV Export:** Export contacts to a CSV file for backup or external use.

## Installation

### Prerequisites

* PHP >= 8.2
* Composer
* Laravel
* Node.js & npm

### Steps

1. Clone the repository

```git clone https://github.com/Volodymyr0587/laravel-contacts-app```
```cd laravel-contact-management```

2. Install dependencies

```composer install```
```npm install```
```npm run dev```

3. Set up the environment

```cp .env.example .env```
```php artisan key:generate```

4. Database setup

Using SQLite for simplicity. Update your .env file accordingly:

```DB_CONNECTION=sqlite```

5. Run migrations and seed database with countries information (Alpha-2 codes, names and dial codes)

```php artisan migrate:fresh --seed```

6. Create a symbolic link for storage

```php artisan storage:link```

7. Serve the application

    ```php artisan serve```

## Usage

Register a new user and start managing your contacts with features designed to enhance usability and organization.
