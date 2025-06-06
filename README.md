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

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Test Case: End-to-End Alert Lifecycle with Sanctions 360 Validation Across L2, L3, and Compliance
 
 
---
 
Preconditions:
 
Alert creation functionality is working.
 
Users have valid credentials for L2, L3, and Compliance roles.
 
Sanctions 360 integration is enabled.
 
Test data: valid Client ID.
 
 
 
---
 
Test Steps:
 
1. Create Alert
 
Log in as an L2 user.
 
Create a new alert using a valid Client ID.
 
Note down the generated Alert ID.
 
 
 
2. Go to Investigator Worklist
 
Navigate to the Investigator Worklist screen.
 
Search using the captured Alert ID.
 
 
 
3. Match Selection and Applicability
 
Select “Match” for the alert.
 
Click on the Applicability button.
 
✅ Expected Result: All Enrichment tabs and the Sanctions 360 button should now be visible.
 
 
 
4. Sanctions 360 Client Data Validation
 
Click on the Sanctions 360 button.
 
✅ Expected Result: Client data should be loaded and displayed correctly in the Sanctions 360 popup/screen.
 
 
 
5. Escalate to L3
 
Choose “Match” again.
 
Click on the Escalate button.
 
✅ Expected Result: Alert should move to L3 (Compliance) queue.
 
 
 
6. Login as Compliance (Global User)
 
Log out and log in as a Compliance user (L3/Global).
 
Go to Compliance → My Items worklist.
 
Search for the same Alert ID.
 
 
 
7. Verify Sanctions 360 Visibility in Compliance
 
✅ Expected Result: The Sanctions 360 button and Enrichment tabs should still be visible.
 
 
 
8. Validate Sanctions 360 Client Data Again
 
Click on the Sanctions 360 button.
 
✅ Expected Result: The same client details from previous steps should be visible.
 
 
 
9. Move to Evidence Info Queue
 
Navigate to the Evidence Info Queue.
 
Search for the same Alert ID.
 
 
 
10. Close the Alert
 
 
 
Close the alert from the Evidence Info screen.
 
✅ Expected Result: Alert status should change to Closed.
 
 
11. Verify in L3 Closed Items Queue
 
 
 
Go to the L3 Closed Items Queue.
 
Search for the closed Alert ID.
 
✅ Expected Result: The alert should be listed in the L3 Closed Items Queue.
 
 
12. Verify in L2 All Items Queue
 
 
 
Log out and log back in as the original L2 user.
 
Go to L2 All Items Queue.
 
Search for the closed Alert ID.
 
✅ Expected Result: The alert should be visible in the All Items Queue for L2.
 
 
 
---
 
✅ Expected Final Outcome:
 
Sanctions 360 button and enrichment tabs should consistently be visible across levels.
 
Client data should remain the same across transitions.
 
Alert should properly move through escalation and be trackable in the right queues.
