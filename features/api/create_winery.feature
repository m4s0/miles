Feature: Create Winery
  In order to create a new Winery
  As a http client
  I need to be able to send a request to API and create a Winery

  Scenario: Create a new Winery failed
    When I send a 'POST' request to '/api/winery' with payload
      |name   |city|region|country|
      |       |    |      |       |

    Then I should get a error response with code 400

  Scenario: Create a new Winery successful
    When I send a 'POST' request to '/api/winery' with payload
      |name   |city|region  |country|
      |Pescaja|Asti|Piemonte|Italy  |

    Then I should get a success response with code 201
