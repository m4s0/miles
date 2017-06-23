Feature: Create Wine
  In order to create a new Wine
  As a http client
  I need to be able to send a request to API and create a Wine

  Scenario: Create a new Wine fails
    When I send a 'POST' request to '/api/wines'
    """
    {
       "name":"",
       "price":"",
       "year":"",
       "vineId":"",
       "wineryId":""
    }
    """
    Then I should get a response with code 400 and message
    """
    {
        "message": "Validation failed.",
        "errors": {
            "name": "This value should not be blank.",
            "year": "This value should not be blank.",
            "price": "This value should not be blank.",
            "wineryId": "id  not found.",
            "vineId": "id  not found."
        }
    }
    """

    When I send a 'POST' request to '/api/wines'
    """
    {
       "name":"roero arneis",
       "price":"47",
       "year":"2007",
       "vineId":1,
       "wineryId":1
    }
    """
    Then I should get a response with code 400 and message
    """
    {
       "message":"Validation failed.",
       "errors":{
          "wineryId":"id 1 not found.",
          "vineId":"id 1 not found."
       }
    }
    """

  Scenario: Create a new Wine successful
    Given There are Vines with the following attributes
      |name  |grapes|
      |Arneis|Bianca|
    And There is a Winery with the following attributes
      |name   |city|region|country|
      |Pescaja|Asti|region|Italy  |
    When I send a 'POST' request to '/api/wines'
    """
    {
       "name":"roero arneis",
       "price":"47",
       "year":"2007",
       "vineId":1,
       "wineryId":1
    }
    """
    Then I should get a response with code 201 and message
    """
    {
        "id": 1
    }
    """