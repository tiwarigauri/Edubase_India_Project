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
@Then("the user should see the Sanctions 360 search screen in a new tab")
public void userShouldSeeSanctionsSearchScreenInNewTab() {
    // Wait and capture the URL and BvD ID (assumes they are stored in JS variables or available via attributes)
    WebDriverWait wait = new WebDriverWait(driver, Duration.ofSeconds(10));

    // Example: assuming BvDID and Launch URL are logged or accessible via JS or DOM
    JavascriptExecutor js = (JavascriptExecutor) driver;
    String launchUrl = (String) js.executeScript("return window.sessionStorage.getItem('launchUrl');");
    String bvdId = (String) js.executeScript("return window.sessionStorage.getItem('bvdId');");

    System.out.println("BvD ID: " + bvdId);
    System.out.println("Launch URL: " + launchUrl);

    // Validate BvD ID is null or empty
    Assert.assertTrue("Expected BvD ID to be null/empty", bvdId == null || bvdId.isEmpty());

    // Open new tab and switch to it
    js.executeScript("window.open();");
    ArrayList<String> tabs = new ArrayList<>(driver.getWindowHandles());
    driver.switchTo().window(tabs.get(1));

    // Navigate to the launch URL
    driver.get(launchUrl);

    // Verify Search Screen using input field
    WebElement searchInput = wait.until(ExpectedConditions.visibilityOfElementLocated(By.id("companyName")));
    String placeholder = searchInput.getAttribute("placeholder");
    Assert.assertEquals("Enter name or VDID", placeholder);
}

