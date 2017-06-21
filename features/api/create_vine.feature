Feature: Create Vine
  In order to create a new Vine and Wines
  As a http client
  I need to be able to send a request to API and create a Vine

  Scenario: Create a new Vine failed
    When I send a 'POST' request to '/api/vine' with payload
      |name  |grapes|
      |      |      |

    Then I should get a error response

  Scenario: Create a new Vine successful
    Given I send a 'POST' request to '/api/vine' with payload
      |name  |grapes|
      |Arneis|Bianca|

    Then I should get a success response
