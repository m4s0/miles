Feature: Update Vine
  In order to update an existing Vine
  As a http client
  I need to be able to send a request to API and update a Vine

  Scenario: Update an existing Vine failed
    Given There is a Vine with the following attributes
      |name  |grapes|
      |Arneis|Bianca|

    When I send a 'PUT' request to '/api/vine/123' with payload
      |name  |grapes|
      |      |      |

    Then I should get a error response with code 404

    When I send a 'PUT' request to '/api/vine/1' with payload
      |name  |grapes|
      |      |      |

    Then I should get a error response with code 400

  Scenario: Update an existing Vine successful
    Given There is a Vine with the following attributes
      |name  |grapes|
      |Arneis|Bianca|

    When I send a 'PUT' request to '/api/vine/1' with payload
      |name     |grapes|
      |Nebbiolo |Nera  |

    Then I should get a success response with code 200
