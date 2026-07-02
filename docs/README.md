# Lensora Studio Management System

A full-stack photography studio management system built with PHP, MySQL, JavaScript, HTML, and CSS.

---

## Overview

Lensora Studio is a complete photography studio website and management platform that allows customers to browse services, book photography sessions, submit feedback, and view galleries, while administrators can manage bookings, users, content, and media through a secure admin dashboard.

---

## Features

### Customer Features

* User registration and login
* Secure authentication using PHP sessions
* Browse photography services and packages
* Interactive booking system
* Real-time appointment slot availability
* Feedback submission system
* Dynamic photography galleries
* Video portfolio showcase
* Responsive design for desktop and mobile

### Admin Features

* Admin dashboard
* Manage bookings
* Approve or reject bookings
* Delete bookings
* Manage feedback submissions
* Manage service packages
* Manage photography services
* Manage users and roles
* Upload gallery images
* Delete gallery images
* Manage videos
* Search and filter records

---

## Database Tables

### users

Stores registered user accounts.

Fields include:

* id
* name
* email
* password
* role
* created_at

### bookings

Stores customer booking requests.

Fields include:

* id
* name
* email
* package
* booking_date
* booking_time
* status
* created_at

### feedbacks

Stores customer feedback submissions.

Fields include:

* id
* name
* email
* rating
* comments
* created_at

### services

Stores photography service offerings.

Fields include:

* id
* title
* description
* price
* created_at

### packages

Stores photography packages.

Fields include:

* id
* package_name
* description
* price
* created_at

### gallery_images

Stores gallery image information.

Fields include:

* id
* category
* image_path
* created_at

### site_videos

Stores video portfolio content.

Fields include:

* id
* title
* video_url
* created_at

---

## Authentication System

The application includes:

* User Registration
* User Login
* Session Management
* Logout Functionality
* Role-Based Access Control
* Admin Authorization Checks

Authentication is implemented using PHP sessions and password hashing.

---

## API Endpoints

### Feedback APIs

* add-feedback.php
* delete-feedback.php
* search-feedback.php
* get-feedback.php

### Package APIs

* add-package.php
* delete-package.php
* search-package.php
* get-package.php

### Service APIs

* add-service.php
* delete-service.php
* update-service.php
* search-service.php
* get-service.php

### Booking APIs

* create-booking.php
* get-booking.php
* update-booking-status.php
* get-booked-slots.php

---

## Admin Panel Pages

### dashboard.php

Main administration dashboard.

### bookings-manage.php

Manage customer bookings.

Features:

* Approve bookings
* Reject bookings
* Delete bookings
* Filter by status

### feedback-manage.php

Manage customer feedback.

### services-manage.php

Manage photography services.

### packages-manage.php

Manage photography packages.

### users.php

Manage users and roles.

### update-role.php

Update user permissions.

### gallery-manage.php

Manage gallery images.

### upload-gallery.php

Upload new gallery images.

### delete-gallery.php

Delete gallery images.

### videos-manage.php

Manage video portfolio content.

### delete-video.php

Delete uploaded videos.

---

## Public Pages

### index.php

Home page.

### login.php

User login page.

### register.php

User registration page.

### services.php

Photography services page.

### packages.php

Photography packages page.

### schedule.php

Booking schedule page.

### feedback.php

Customer feedback page.

### video.php

Video showcase page.

### work.php

Photography portfolio gallery.

---

## File Structure

lensora/

├── admin/
│   ├── dashboard.php
│   ├── bookings-manage.php
│   ├── feedback-manage.php
│   ├── services-manage.php
│   ├── packages-manage.php
│   ├── users.php
│   ├── update-role.php
│   ├── gallery-manage.php
│   ├── upload-gallery.php
│   ├── delete-gallery.php
│   ├── videos-manage.php
│   └── delete-video.php
│
├── api/
│   ├── add-feedback.php
│   ├── delete-feedback.php
│   ├── search-feedback.php
│   ├── get-feedback.php
│   ├── add-package.php
│   ├── delete-package.php
│   ├── search-package.php
│   ├── get-package.php
│   ├── add-service.php
│   ├── delete-service.php
│   ├── update-service.php
│   ├── search-service.php
│   ├── get-service.php
│   ├── create-booking.php
│   ├── get-booking.php
│   ├── update-booking-status.php
│   └── get-booked-slots.php
│
├── includes/
│   ├── auth.php
│   ├── db.php
│   ├── header_nav.php
│   └── footer.php
│
├── pages/
│   ├── services.php
│   ├── packages.php
│   ├── schedule.php
│   ├── feedback.php
│   ├── video.php
│   └── work.php
│
├── global/
│   ├── main.css
│   ├── profile.css
│   └── print.css
│
├── scripts/
│   └── main.js
│
├── uploads/
│
├── login.php
├── register.php
├── index.php
└── README.md

---

## Technologies Used

### Frontend

* HTML5
* CSS3
* JavaScript (Vanilla JS)
* Font Awesome

### Backend

* PHP 8+

### Database

* MySQL

### Server Environment

* Apache
* XAMPP /MAMP

---

## Security Features

* Password hashing
* Session authentication
* Prepared SQL statements
* Role-based authorization
* File upload validation
* Input validation and sanitization
* XSS protection using htmlspecialchars()

---



© 2026 Lensora Studio. All Rights Reserved.
