Feature: Create Winery
  In order to create a new Winery
  As a http client
  I need to be able to send a request to API and create a Winery

  Scenario: Create a new Winery fails
    When I send a 'POST' request to '/api/wineries'
    """
    {
       "name":"",
       "city":"",
       "region":"",
       "country":""
    }
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

  Scenario: Create a new Winery successful
    When I send a 'POST' request to '/api/wineries'
    """
    {
       "name":"Pescaja",
       "city":"Asti",
       "region":"Piemonte",
       "country":"Italy"
    }
    """
    Then I should get a response with code 201 and message
    """
    {
        "id": 1
    }
    """