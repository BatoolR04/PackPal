## PackPal - Travel Packing List Generator

Batool Raza  
110096948
University of Windsor  
World Wide Web Information

## Project Overview

PackPal is a dynamic, PHP/MySQL-based web application that helps users plan trips and generate customized packing lists for different types of travel: Beach, City, Hiking, and Winter. It includes admin functionality, responsive design, and multimedia integration.

## Live Website

http://raza43.myweb.cs.uwindsor.ca/PackPal

## Folder Structure

PackPal/
├── assets/
│   ├── css/                 # Main and theme CSS files
│   └── images/              # Backgrounds and media images
│   └── js/                  # JavaScript files
├── help/                    # Help wiki pages
│   ├── adminfeatures.php/   # Admin controls guide
│   └── customizing.php/     # Theme and site customization
│   └── howto.php/           # How to use PackPal
│   └── howtopack.php/       # Packing tips
│   └── index.php/           # Help index page
│   └── savinglists.php/     # Saving and printing lists
│   └── triptypes.php/       # Trip type details
├── includes/
│   └── db.php               # Database connection file
│   └── theme.php/           # Theme background logic
├── index.php                # Homepage
├── tripForm.php             # Form to create trips
├── listView.php             # Packing list with chart and video
├── register.php             # User registration
├── register_handler.php     # Processes registration
├── login.php                # User login
├── logout.php               # User logout
├── dashboard.php            # User dashboard
├── deleteTrip.php           # Deletes saved trip
├── saveTrip.php             # Saves a trip
├── viewTrips.php            # View user trips
├── profile.php              # User profile page
├── about.php                # Project and media description
├── admin.php                # Admin dashboard
├── admin_edit_trip.php      # Edit user trips
├── admin_users.php          # Manage users
├── admin_trips.php          # Manage user trips
├── admin_theme.php          # Change site theme
├── admin_monitor.php        # Site monitoring
├── admin_help.php           # Admin help wiki
├── admin_toggle.php         # Enable/disable accounts
├── sitemap.html             # SEO sitemap
├── contact.html             # Contact info
├── faq.html                 # FAQ page
├── terms.html               # Terms of use
├── privacy.html             # Privacy policy
├── packpal.sql              # MySQL export file
└── README.md                # This file

## How to Install

## Steps:

1. Upload Project Files
   - Download or clone the full PackPal project folder.
   - Upload all files to your hosting server’s root folder (e.g., public_html or a folder like /PackPal).
   - Ensure that the full folder structure is preserved, including:
         - includes/
         - assets/ (with subfolders for css, js, images)
         - All .php, .html, and .sql files.

2. Create and Import the Database
   - Log into your hosting service’s phpMyAdmin.
   - Create a new database, for example: packpal_db.
   - Use the Import function in phpMyAdmin to upload the packpal.sql file included in your project folder.
   - This will create the necessary tables like users, trips, and site_settings.

3. Configure Database Connection
   - Open the file includes/db.php.
   - Update the database connection settings to match your server’s credentials:
            $host = 'localhost';          // or your host name
            $username = 'your_db_user';   // your MySQL username
            $password = 'your_db_pass';   // your MySQL password
            $database = 'packpal_db';     // your database name
   - Save the changes.

4. Admin Login Credentials
   - A default admin account is included so you can log into the admin dashboard:
         - Username: ADMIN
         - Email: packpal@gmail.com
         - Password: 12345
   - Once logged in, you can:
      - Change the site’s theme
      - Disable/enable user accounts
      - View and delete user trips
      - Monitor site activity

5. Launch the Website
   - Open your browser and go to the URL where you uploaded the project.
   - Register as a new user, or log in using the admin credentials above.
   - Start using PackPal!

---

## Database Info

### Tables:
- `users`: stores user data, admin flag, active status
- `trips`: stores user trips and details
- `site_settings`: stores current theme setting

**SQL Export File:** `packpal.sql` (included in root directory)

---

## Media + Credits

- Images from [Unsplash](https://unsplash.com) and [Pexels](https://pexels.com)
- YouTube travel creator videos embedded with attribution
- Icons and styles used under fair use and educational licensing

---

## Help Pages

All help documentation is in the `/help/` directory and includes:
- How to plan a trip
- How to use packing list
- How to register/login
- Admin guide
- Template switching

---

## User Types

- **Users:** Can register, save trips, view packing list
- **Admins:** Can manage users, trips, theme, and monitor data

---

## SEO Optimization

- Meta tags, alt text, and `sitemap.html` provided
- Responsive and mobile-friendly

---

## Support

For questions or issues, contact Batool Raza at raza43@uwindsor.ca

---

© 2025 PackPal. Educational use only.
