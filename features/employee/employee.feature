Feature: Manage employees informations
  In order to manage employees in the company
  As a human resources manager
  I need to have employee database

  Background:
    Given the following employees:
      | name   | position | salary scale | is fired |
      | Fred   | CEO      | 10           | no       |
      | Benoit | CTO      | 8            | no       |
      | Pipou  | Dev      | 3            | no       |
      | Willy  | Trainee  | 1            | no       |
      | Arnaud | Lead dev | 5            | no       |

  Scenario: Search employees
    Given I am on employee list page
    Then I should see 5 employees

  Scenario: Hire an employee
    Given I am on the homepage
    When I follow "New employee"
    And I fill in "Name" with "Olivier"
    And I fill in "Position" with "Trainee"
    And I fill in "Salary scale" with "1"
    And I press "Validate"
    Then I should be on the employee list page
    And I should see "New employee has been successfully added!"

  Scenario: Promote an employee
    Given I am on the homepage
    When I want to promote "Oliver"
    And I fill in "Position" with "Dev"
    And I fill in "Salary scale" with "5"
    And I press "Validate"
    Then I should be on the employee list page
    And I should see "Olivier has been successfully promoted to Dev!"

  Scenario: Fire an employee
    Given I am on the homepage
    When I want to fire "Pipou"
    And I press "Validate"
    Then I should be on the employee list page
    And I should see "Pipou has been successfully fired!"