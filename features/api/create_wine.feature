Feature: Create Wine
  In order to create a new Wine
  As a http client
  I need to be able to send a request to API and create a Wine

  Scenario: Create a new Wine failed
    When I send a 'POST' request to '/api/wine' with payload
      |name        |price|year|vineId|wineryId|
      |            |     |    |      |        |

    Then I should get a error response with code 400

    When I send a 'POST' request to '/api/wine' with payload
      |name        |price|year|vineId|wineryId|
      |roero arneis|47   |2007|1     |1       |

    Then I should get a error response with code 400

  Scenario: Create a new Wine successful
    Given There is a Vine with the following attributes
      |name  |grapes|
      |Arneis|Bianca|

    And There is a Winery with the following attributes
      |name   |city|region|country|
      |Pescaja|Asti|region|Italy  |

    When I send a 'POST' request to '/api/wine' with payload
      |name        |price|year|vineId|wineryId|
      |roero arneis|47   |2007|1     |1       |

    Then I should get a success response with code 201
