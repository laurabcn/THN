Feature: Get user name who have booked
  As unauthenticated User
  I can see users names

  Scenario: A unauthenticated user can see the user have booked but hotel don't have
    When A "GET" request body is sent to "/booking/users"
    Then the response should be "204"

  Scenario: A unauthenticated user can see the user have booked
    Given A user with id "98d51de1-15a0-4615-b13a-54b702b32458"
    When A "GET" request body is sent to "/booking/users"
    Then the response should be "200"