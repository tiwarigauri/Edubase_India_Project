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




















Feature: AMC API Authentication and GFC to BvD ID mapping
 
  Scenario: Verify valid GFC ID returns correct BvD ID
    Given I have a valid access token
    When I send a request with GFC ID "CITI123456"
    Then the API should return BvD ID "BVD998877"
 
import io.cucumber.java.en.*;
import io.restassured.response.Response;
 
import static io.restassured.RestAssured.*;
import static org.junit.Assert.*;
 
public class GfcToBvdSteps {
 
    private String token;
    private Response response;
    private String gfcId;
 
    @Given("I have a valid access token")
    public void i_have_a_valid_access_token() throws Exception {
        token = AMCAuthUtils.fetchAccessToken(); // uses developer’s getToken() logic
        assertNotNull("Access token should not be null", token);
    }
 
    @When("I send a request with GFC ID {string}")
    public void i_send_a_request_with_gfc_id(String gfcId) {
        this.gfcId = gfcId;
 
        String baseUrl = mapPropertyKeyValue.get("AMC_API_BASE_URL");
 
        response = given()
                .baseUri(baseUrl)
                .header("Authorization", "Bearer " + token)
                .header("Accept", "application/json")
                .queryParam("gfcId", gfcId) // Or use .body() if POST
                .when()
                .get("/v1/gfc-to-bvd"); // Replace with actual endpoint path
    }
 
    @Then("the API should return BvD ID {string}")
    public void the_api_should_return_bvd_id(String expectedBvdId) {
        response.then().statusCode(200);
        String actualBvdId = response.jsonPath().getString("bvdId");
        assertEquals("Mismatch in BvD ID", expectedBvdId, actualBvdId);
    }
}
 
public class AMCAuthUtils {
    public static String fetchAccessToken() throws Exception {
        return YourTokenClass.getToken(); // Developer-provided method
    }
}
 
