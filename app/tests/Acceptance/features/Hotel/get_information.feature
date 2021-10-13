Feature: Get hotel information
  As unauthenticated User
  I can see information data

  Scenario: A unauthenticated user can see the hotel information
    Given An hotel with id "ce10f290-eb12-4e98-82ff-37e0a0b16ae2"
    When A "GET" request body is sent to "/hotel/ce10f290-eb12-4e98-82ff-37e0a0b16ae2"
    Then the response should be "200"

  Scenario: A unauthenticated user can see the hotel information but the Hotel non exist
    When A "GET" request body is sent to "/hotel/ce10f290-eb12-4e98-82ff-37e0a0b16a11"
    Then the response should be "204"