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


Following our recent testing analysis, I would like to bring to your attention a couple of issues we have observed:

As per our previous analysis, the message “Refused to connect to Moody’s login page” should be displayed to users who are currently logged into CSawc but do not have a valid email address with the @citi.com domain. However, during Diane’s testing using a valid user ID on the Edge browser, she encountered the “Refused to connect” message and was unable to see client details. Interestingly, when she tested the same alert and user ID on Chrome, the client details were displayed correctly. This discrepancy between browsers needs further investigation.

Additionally, I noticed an issue while clicking the Moody’s button for an alert associated with a user having a valid email ID. On the first click, a popup displayed the error message “Cannot destructure property 'data'” (please refer to the attached screenshots). Checking the browser console revealed some JavaScript errors. After closing the popup and clicking the Moody’s button again, the client details appeared correctly. This suggests a possible intermittent JavaScript issue that requires attention.

Please find the relevant screenshots attached for your reference.

Kindly look into these matters and advise on the next steps. Let me know if you need any further information from our side.

Best regards,
[Your Name]
[Your Position]
[Your Contact Information]

