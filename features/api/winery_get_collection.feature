Feature: Get Wineries
  In order to get a collection existing Wineries
  As a http client
  I need to be able to send a request to API and get a collection of Wineries

  Scenario: Get a collection of existing Wineries
    Given There are Wineries with the following attributes
      |name        |city |region  |country|
      |Pescaja     |Asti |Piemonte|Italy  |
      |Giacomo Vico|Cuneo|Piemonte|Italy  |

    When I send a 'GET' request to '/api/wineries'
    Then I should get a response with code 200 and message
    """
    [
        {
           "id":1,
           "name":"Pescaja",
           "city":"Asti",
           "region":"Piemonte",
           "country":"Italy"
        },
        {
           "id":2,
           "name":"Giacomo Vico",
           "city":"Cuneo",
           "region":"Piemonte",
           "country":"Italy"
        }
    ]
    """
