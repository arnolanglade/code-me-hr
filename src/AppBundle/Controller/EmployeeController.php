<?php

namespace AppBundle\Controller;

use AppBundle\Employee\PromoteEmployeeCommand;
use AppBundle\Form\EmployeeType;
use Component\Employee\Employee;
use AppBundle\Employee\HireEmployeeCommand;
use Infrastructure\Employee\Criteria\SearchCriteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends Controller
{
    /**
     * @Route("/employee", name="employee_list")
     */
    public function listAction(Request $request)
    {
        $searchCriteria = new SearchCriteria(
            $request->get('name'),
            $request->get('position'),
            (bool) $request->get('is_fired')
        );

        $paginatedEmployees = $this->get('employee.repository')->match($searchCriteria);
        $paginatedEmployees->setCurrentPage($request->get('page', 1));

        return $this->render('employee/list.html.twig', [
            'employees' => $paginatedEmployees
        ]);
    }

    /**
     * @Route("/employee/hire", name="employee_hire")
     */
    public function hireAction(Request $request)
    {
        $form = $this->createForm(EmployeeType::class, new HireEmployeeCommand());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var HireEmployeeCommand $employeeCommand */
            $employeeCommand = $form->getData();
            $employee = Employee::hire(
                $employeeCommand->getName(),
                $employeeCommand->getPosition(),
                $employeeCommand->getSalaryScale()
            );

            $this->get('employee.repository')->save($employee);

            return $this->redirectToRoute('employee_list');
        }

        return $this->render('employee/hire.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/employee/{id}/promote", name="employee_promote")
     */
    public function promoteAction(Employee $employee, Request $request)
    {
        $form = $this->createForm(EmployeeType::class, new HireEmployeeCommand());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var PromoteEmployeeCommand $employeeCommand */
            $employeeCommand = $form->getData();
            $employee->promote(
                $employeeCommand->getNewPosition(),
                $employeeCommand->getNewSalaryScale()
            );

            $this->get('employee.repository')->save($employee);

            return $this->redirectToRoute('employee_list');
        }

        return $this->render('employee/promote.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/employee/{id}/fire", name="employee_fire")
     */
    public function fireAction(Employee $employee)
    {
        $employee->fire();

        $this->get('employee.repository')->save($employee);
    }
}
