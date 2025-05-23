PHP Application Form - README

Overview

This project contains a PHP-based application form. The code is designed to run on a local server and can be viewed in a web browser. Follow the steps below to set up and run the application.

Prerequisites

To run this project, ensure you have the following installed on your system:

PHP (version 7.4 or higher)

Verify installation by running:

php -v

If PHP is not installed, download it from php.net.

Web Browser

Any modern browser (e.g., Chrome, Firefox, Edge).

VSCode (Optional)

Install the following extensions for better PHP development:

PHP Intelephense

PHP Server

Steps to Run the Application

1. Clone or Download the Project

Save the php_application_form.php file in a dedicated folder on your computer.

2. Start a Local PHP Server

Open a terminal or command prompt.

Navigate to the folder containing the PHP file:

cd /path/to/your/php/file

Start the PHP built-in server:

php -S localhost:8000

The server will start, and you can access the application at:

http://localhost:8000/php_application_form.php

3. Open the Application in a Browser

Open your web browser and visit the URL:

http://localhost:8000/php_application_form.php

Optional: Using PHP Server Extension in VSCode

If you prefer running the project directly in VSCode:

Install the PHP Server extension.

Open php_application_form.php in VSCode.

Right-click anywhere in the file and select "PHP Server: Serve Project".

A URL will appear in the terminal. Open it in your browser to view the application.

Notes

Since the application interacts with a database, ensure:

The database server (e.g., MySQL) is installed and running.

The database is configured correctly in the PHP code.

For troubleshooting, check the terminal or browser console for errors.

Support

If you encounter any issues running the project, please contact me. I would be happy to help.


Feature: AMC API Failure Scenarios

  Scenario: Handle 400 Bad Request when fetching BvDID from AMC
    Given a CSAW-C Level 2 user accesses the KYC SMB alert
    When the user clicks on "Launch Sanctions 360"
    And the AMC API returns 400 Bad Request
    Then the system should store the error message "Bad Request - Missing parameters"
    And the BvDID should be null

  Scenario: Handle 401 Unauthorized when fetching BvDID from AMC
    Given a CSAW-C Level 3 user accesses the KYC SMB alert
    When the user clicks on "Launch Sanctions 360"
    And the AMC API returns 401 Unauthorized
    Then the system should store the error message "Unauthorized - Invalid token"
    And the BvDID should be null

  Scenario: Handle 403 Forbidden when fetching BvDID from AMC
    Given a CSAW-C Level 2 user accesses the KYC SMB alert
    When the user clicks on "Launch Sanctions 360"
    And the AMC API returns 403 Forbidden
    Then the system should store the error message "Forbidden - Token not provided"
    And the BvDID should be null

  Scenario: Handle 404 Not Found when fetching BvDID from AMC
    Given a CSAW-C Level 3 user accesses the KYC SMB alert
    When the user clicks on "Launch Sanctions 360"
    And the AMC API returns 404 Not Found
    Then the system should store the error message "Not Found - Invalid GFC ID/Host"
    And the BvDID should be null

  Scenario: Handle 409 Conflict when fetching BvDID from AMC
    Given a CSAW-C Level 2 user accesses the KYC SMB alert
    When the user clicks on "Launch Sanctions 360"
    And the AMC API returns 409 Conflict
    Then the system should store the error message "Conflict - Duplicate/Invalid state"
    And the BvDID should be null

  Scenario: Handle 500 Internal Server Error when fetching BvDID from AMC
    Given a CSAW-C Level 3 user accesses the KYC SMB alert
    When the user clicks on "Launch Sanctions 360"
    And the AMC API returns 500 Internal Server Error
    Then the system should store the error message "Internal Server Error"
    And the BvDID should be null

  Scenario: Handle 503 Service Unavailable when fetching BvDID from AMC
    Given a CSAW-C Level 2 user accesses the KYC SMB alert
    When the user clicks on "Launch Sanctions 360"
    And the AMC API returns 503 Service Unavailable
    Then the system should store the error message "Service Unavailable - AMC down"
    And the BvDID should be null

