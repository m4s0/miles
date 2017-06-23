Feature: Update Winery
  In order to update a new Winery
  As a http client
  I need to be able to send a request to API and update a Winery

  Scenario: Update a new wineries fails
    Given There are Wineries with the following attributes
      |name   |city|region|country|
      |Pescaja|Asti|region|Italy  |
    When I send a 'PUT' request to '/api/wineries/123'
    """
    {
       "name":"Giacomo Vico",
       "city":"Cuneo",
       "region":"Piemonte",
       "country":"Italy"
    }
    """
    Then I should get a response with code 404 and message
    """
    {
        "message": "Winery id 123 not found."
    }
    """
    When I send a 'PUT' request to '/api/wineries/1'
    """
    {}
    """
    Then I should get a response with code 400 and message
    """
    {
        "message": "Validation failed.",
        "errors": {
            "name": "This value should not be blank.",
            "city": "This value should not be blank.",
            "region": "This value should not be blank.",
            "country": "This value should not be blank."
        }
    }
    """

  Scenario: Update a new Winery successful
    Given There are Wineries with the following attributes
      |name   |city|region|country|
      |Pescaja|Asti|region|Italy  |
    When I send a 'PUT' request to '/api/wineries/1'
    """
    {
       "name":"Giacomo Vico",
       "city":"Cuneo",
       "region":"Piemonte",
       "country":"Italy"
    }
    """
    Then I should get a response with code 200 and message
    """
    {
        "id": 1
    }
    """