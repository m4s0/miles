Feature: Get Vines
  In order to get a collection of existing Vines
  As a http client
  I need to be able to send a request to API and get a collection of Vines

  Scenario: Get a collection of existing Vines
    Given There are Vines with the following attributes
      |name      |grapes|
      |Arneis    |Bianca|
      |Nebbiolo  |Nera  |
      |Vermentino|Bianca|
    When I send a 'GET' request to '/api/vines'
    Then I should get a response with code 200 and message
    """
    [
        {
            "id": 1,
            "name": "Arneis",
            "grapes": "Bianca"
        },
        {
            "id": 2,
            "name": "Nebbiolo",
            "grapes": "Nera"
        },
        {
            "id": 3,
            "name": "Vermentino",
            "grapes": "Bianca"
        }
    ]
    """
