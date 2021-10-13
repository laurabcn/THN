Feature: Get Rooms registered
  As unauthenticated User
  I can see rooms

  Scenario: A unauthenticated user can see the rooms registered but the Hotel hasn't
    When A "GET" request body is sent to "/booking"
    Then the response should be "204"

  Scenario: A unauthenticated user can see the rooms registered
    Given A room with id "98d51de1-15a0-4615-b13a-54b702b32458"
    When A "GET" request body is sent to "/booking"
    Then the response should be "200"