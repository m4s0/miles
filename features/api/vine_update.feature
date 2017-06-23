Feature: Update Vine
  In order to update an existing Vine
  As a http client
  I need to be able to send a request to API and update a Vine

  Scenario: Update an existing Vine fails
    Given There are Vines with the following attributes
      |name  |grapes|
      |Arneis|Bianca|
    When I send a 'PUT' request to '/api/vines/123'
    """
    {
       "name":"Nebbiolo",
       "grapes":"Nera"
    }
    """
    Then I should get a response with code 404 and message
    """
    {
        "message": "Vine id 123 not found."
    }
    """
    When I send a 'PUT' request to '/api/vines/1'
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

  Scenario: Update an existing Vine successful
    Given There are Vines with the following attributes
      |name  |grapes|
      |Arneis|Bianca|
    When I send a 'PUT' request to '/api/vines/1'
    """
    {
       "name":"Nebbiolo",
       "grapes":"Nera"
    }
    """
    Then I should get a response with code 200 and message
    """
    {
        "id": 1
    }
    """