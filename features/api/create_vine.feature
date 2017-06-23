Feature: Create Vine
  In order to create a new Vine and Wines
  As a http client
  I need to be able to send a request to API and create a Vine

  Scenario: Create a new Vine failed
    When I send a 'POST' request to '/api/vines'
    """
    {}
    """
    Then I should get a response with code 400 and message
    """
    {
        "message": "Validation failed.",
        "errors": {
            "name": "This value should not be blank.",
            "grapes": "This value should not be blank."
        }
    }
    """

  Scenario: Create a new Vine successful
    Given I send a 'POST' request to '/api/vines'
    """
    {
       "name":"Arneis",
       "grapes":"Bianca"
    }
    """
    Then I should get a response with code 201 and message
    """
    {
        "id": 1
    }
    """