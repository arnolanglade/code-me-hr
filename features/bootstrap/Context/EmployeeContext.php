<?php

namespace Al\Behat\Context;

use Al\Component\Employee\Employee;
use Al\Component\Employee\EmployeeRepositoryInterface;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Element\NodeElement;
use Behat\Mink\Exception\ElementNotFoundException;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\Instantiator\Instantiator;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

final class EmployeeContext extends RawMinkContext implements Context
{
    /** @var EmployeeRepositoryInterface */
    private $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @Given the following employees:
     */
    public function theFollowingEmployees(TableNode $employees)
    {
        $instantiator = new Instantiator();
        $hydrator = \Closure::bind(function (Employee $employee, array $flatEmployee) {
            foreach ($flatEmployee  as $field => $value) {
                $field = Inflector::camelize($field);
                if ('is fired' === $value) {
                    $value =  'yes' === $value ? true : false;
                }

                $employee->$field = $value;
            }
            $employee->id = Uuid::uuid4();
        }, null, Employee::class);


        foreach ($employees as $flatEmployee) {
            $employee = $instantiator->instantiate(Employee::class);
            $hydrator($employee, $flatEmployee);
            $this->employeeRepository->add($employee);
        }
    }

    /**
     * @Given I am on employee list page
     */
    public function iAmOnTheEmployeeListPage()
    {
        $this->visitPath('/employee');
    }

    /**
     * @Then I should be on the employee list page
     */
    public function iShouldBeOnTheEmployeeListPage()
    {
        $this->assertSession()->addressEquals($this->locatePath('/employee'));
    }

    /**
     * @Then I should see :count employees
     */
    public function iShouldSeeEmployees($expectedCount)
    {
        $rows = $this->getSession()->getPage()->findAll('css', 'table tbody tr');

        Assert::count($rows, $expectedCount);
    }

    /**
     * @When I want to promote :name
     */
    public function iWantToPromote($name)
    {
        $this->findEmployeeInTable($name)->find('css', 'a.promote')->click();
    }

    /**
     * @When I want to fire :name
     */
    public function iWantToFire($name)
    {
        $this->findEmployeeInTable($name)->find('css', 'a.fire')->click();
    }

    /**
     * @param string $name
     *
     * @return NodeElement
     *
     * @throws ElementNotFoundException
     */
    private function findEmployeeInTable(string $name): NodeElement
    {
        $selectorType = 'css';
        $selector = sprintf('table tbody tr:contains("%s")', $name);

        if (null === $row = $this->getSession()->getPage()->find($selectorType, $selector, $name)) {
            throw new ElementNotFoundException($this->getSession()->getDriver(), 'element', $selectorType, $selector);
        }

        return $row;
    }
}
