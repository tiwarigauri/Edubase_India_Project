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

-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Subject: Update on Defect Raised by ICRM Team – Moody's Integration Issue

Hi [Recipient's Name],

I hope you are doing well.

This is regarding the defect raised by the ICRM team related to the Moody’s integration issue. We understand the urgency and wanted to share an update along with the reasons for the delay in resolution.

After thorough analysis and continuous follow-up with the Moody’s team, we have identified that the root cause of the issue lies on their end. Please find below a summary of our findings and communication so far:

On June 12th, we analyzed that the issue was occurring due to the sub field in the payload and reached out to the Moody’s team for further clarification.

We also observed that the Moody’s screen behaves inconsistently – sometimes it works for the same alert ID and sometimes it does not. This behavior has been communicated to the Moody’s team.

Subsequently, we identified that the “Refused to connect” issue was related to the email field. Initially, Moody’s confirmed that this field was optional. However, after deeper analysis and discussions with them, it was clarified that only user IDs with valid email addresses (domain @citi.com) are able to see the client details on the Moody’s popup. For user IDs without a valid email, the popup redirects to the Moody’s login page with the connection refusal.

Further testing on the Edge browser revealed that even valid user IDs with proper email addresses were facing the same issue. We escalated this to the Moody’s team a few days ago.

In response, they requested additional data including the HAR file for further analysis. We will be sharing a follow-up email today with the requested details to help expedite the fix.

We truly appreciate your patience and understanding while we work with the Moody’s team to resolve this. We will continue to keep you informed of any updates or progress on this issue.

Please find attached all the relevant emails we have sent to the Moody’s team so far for your reference.
