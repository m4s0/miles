Feature: Get Winery
  In order to get an existing Winery
  As a http client
  I need to be able to send a request to API and get a Winery

  Scenario: Get an existing wineries fails
    Given There are Wineries with the following attributes
      |name   |city|region  |country|
      |Pescaja|Asti|Piemonte|Italy  |
    When I send a 'GET' request to '/api/wineries/123'
    Then I should get a response with code 404 and message
    """
    {
        "message": "Winery id 123 not found."
    }
    """

  Scenario: Get an existing Winery successful
    Given There are Wineries with the following attributes
      |name   |city|region  |country|
      |Pescaja|Asti|Piemonte|Italy  |
    When I send a 'GET' request to '/api/wineries/1'
    Then I should get a response with code 200 and message
    """
    {
       "id":1,
       "name":"Pescaja",
       "city":"Asti",
       "region":"Piemonte",
       "country":"Italy"
    }
    """