Feature: Get Vine
  In order to get an existing Vine
  As a http client
  I need to be able to send a request to API and get a Vine

  Scenario: Get an existing Vine fails
    Given There are Vines with the following attributes
      |name  |grapes|
      |Arneis|Bianca|
    When I send a 'GET' request to '/api/vines/123'
    Then I should get a response with code 404 and message
    """
    {
        "message": "Vine id 123 not found."
    }
    """

  Scenario: Get an existing Vine successful
    Given There are Vines with the following attributes
      |name  |grapes|
      |Arneis|Bianca|
    When I send a 'GET' request to '/api/vines/1'
    Then I should get a response with code 200 and message
    """
    {
       "id": 1,
       "name":"Arneis",
       "grapes":"Bianca"
    }
    """