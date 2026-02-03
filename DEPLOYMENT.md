# Deployment Guide for Hostinger

This guide explains how to deploy the ETAAM project to Hostinger.

## 1. Prepare Environment
- Login to your Hostinger hPanel.
- Go to **Websites** -> **Manage** -> **File Manager**.
- Go to `public_html`.

## 2. Upload Files
- Upload the `etaam_deploy.zip` file.
- Right-click and **Extract** content to `public_html`.
- Ensure files (`index.php`, `admin.php`, etc.) are directly in `public_html` (or your subdirectory), not nested inside another folder.

## 3. Database Setup
- Go to **Databases** -> **Management** in Hostinger.
- Create a new MySQL Database.
  - Note the **Database Name**, **MySQL Username**, and **Password**.
- Click **Enter phpMyAdmin**.
- Select your new database.
- Click **Import** tab.
- Choose file `etaam_db_export.sql` (located in the root of the extracted files).
- Click **Go** to import the database structure and data.

## 4. Connect Application
- Open File Manager again.
- Edit `includes/db_connect.php`.
- Update the following lines with your Hostinger database details:

```php
$host = 'localhost'; // Usually stays localhost on Hostinger
$dbname = 'u123456789_etaam_db'; // Your DB Name
$username = 'u123456789_admin'; // Your DB User
$password = 'YourStrongPassword!'; // Your DB Password
```
- Save the file.

## 5. Final Checks
- Visit your website URL.
- Go to `/admin.php` to login.
- default admin user: `root` / `root` (or whatever existing user you have).
- **Security Note**: Delete `etaam_db_export.sql` from the server after import.
