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

Feature: AMC API Failure Scenarios - BvDID Verification

  Scenario: Handle 400 Bad Request when fetching BvDID from AMC
    Given a CSAW-C Level 2 user accesses the KYC SMB alert
    When the user clicks on the applicability button
    And the AMC API returns 400 Bad Request
    Then the BvDID should be null
    And the user should see the search screen after clicking "Launch Sanctions 360"

  Scenario: Handle 401 Unauthorized when fetching BvDID from AMC
    Given a CSAW-C Level 3 user accesses the KYC SMB alert
    When the user clicks on the applicability button
    And the AMC API returns 401 Unauthorized
    Then the BvDID should be null
    And the user should see the search screen after clicking "Launch Sanctions 360"

  Scenario: Handle 403 Forbidden when fetching BvDID from AMC
    Given a CSAW-C Level 2 user accesses the KYC SMB alert
    When the user clicks on the applicability button
    And the AMC API returns 403 Forbidden
    Then the BvDID should be null
    And the user should see the search screen after clicking "Launch Sanctions 360"

  Scenario: Handle 404 Not Found when fetching BvDID from AMC
    Given a CSAW-C Level 3 user accesses the KYC SMB alert
    When the user clicks on the applicability button
    And the AMC API returns 404 Not Found
    Then the BvDID should be null
    And the user should see the search screen after clicking "Launch Sanctions 360"

  Scenario: Handle 409 Conflict when fetching BvDID from AMC
    Given a CSAW-C Level 2 user accesses the KYC SMB alert
    When the user clicks on the applicability button
    And the AMC API returns 409 Conflict
    Then the BvDID should be null
    And the user should see the search screen after clicking "Launch Sanctions 360"

  Scenario: Handle 500 Internal Server Error when fetching BvDID from AMC
    Given a CSAW-C Level 3 user accesses the KYC SMB alert
    When the user clicks on the applicability button
    And the AMC API returns 500 Internal Server Error
    Then the BvDID should be null
    And the user should see the search screen after clicking "Launch Sanctions 360"

  Scenario: Handle 503 Service Unavailable when fetching BvDID from AMC
    Given a CSAW-C Level 2 user accesses the KYC SMB alert
    When the user clicks on the applicability button
    And the AMC API returns 503 Service Unavailable
    Then the BvDID should be null
    And the user should see the search screen after clicking "Launch Sanctions 360"



import com.github.tomakehurst.wiremock.WireMockServer;
import com.github.tomakehurst.wiremock.core.WireMockConfiguration;
import com.github.tomakehurst.wiremock.client.WireMock;
import io.cucumber.java.en.*;
import org.junit.Assert;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;
import java.time.Duration;
import java.util.logging.Level;

public class AMCFailureSteps {

    private WebDriver driver;
    private WebDriverWait wait;
    private WireMockServer wireMockServer;

    @Given("a CSAW-C Level {int} user accesses the KYC SMB alert")
    public void accessKycSmbAlert(int level) {
        driver = new ChromeDriver();
        wait = new WebDriverWait(driver, Duration.ofSeconds(10));

        // Start WireMock on port 8081
        wireMockServer = new WireMockServer(WireMockConfiguration.options().port(8081));
        wireMockServer.start();
        WireMock.configureFor("localhost", 8081);

        driver.get("http://localhost:3000/kyc-smb-alert"); // Replace with actual URL
    }

    @When("the user clicks on the applicability button")
    public void clickApplicabilityButton() {
        WebElement applicabilityButton = wait.until(ExpectedConditions.elementToBeClickable(By.id("applicabilityBtn")));
        applicabilityButton.click();

        // Wait for the Launch Sanctions 360 button to appear
        wait.until(ExpectedConditions.visibilityOfElementLocated(By.id("launchSanctionsBtn")));
    }

    @And("the AMC API returns {int} {word}")
    public void amcApiReturnsStatus(int statusCode, String statusName) {
        // Mock AMC API failure response
        WireMock.stubFor(WireMock.post("/amc/bvdid")
                .willReturn(WireMock.aResponse()
                        .withStatus(statusCode)
                        .withBody("{\"error\":\"" + statusName + "\"}")));
    }

    @Then("the BvDID should be null")
    public void verifyBvdidIsNull() {
        // Wait and check console logs for BvDID
        LogEntries logs = driver.manage().logs().get(LogType.BROWSER);
        boolean isBvdidNull = logs.getAll().stream().anyMatch(log -> log.getMessage().contains("bvdId=null"));
        Assert.assertTrue("Expected BvDID to be null", isBvdidNull);
    }

    @And("the user should see the search screen after clicking \"Launch Sanctions 360\"")
    public void verifySearchScreenAppears() {
        WebElement launchBtn = wait.until(ExpectedConditions.elementToBeClickable(By.id("launchSanctionsBtn")));
        launchBtn.click();

        // Switch to iframe where search screen appears (replace 'frameId' with actual ID)
        wait.until(ExpectedConditions.frameToBeAvailableAndSwitchToIt(By.id("searchPopupFrame")));

        // Check for unique element on search screen (replace with actual selector)
        WebElement searchScreen = wait.until(ExpectedConditions.visibilityOfElementLocated(By.id("searchScreen")));
        Assert.assertTrue("Search screen is not displayed", searchScreen.isDisplayed());

        // Switch back to default content
        driver.switchTo().defaultContent();
    }

    @After
    public void tearDown() {
        if (wireMockServer != null) wireMockServer.stop();
        if (driver != null) driver.quit();
    }
}


