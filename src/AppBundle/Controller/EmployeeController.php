<?php

namespace Al\AppBundle\Controller;

use Al\Application\Employee\Command\FireEmployee;
use Al\Application\Employee\Command\PromoteEmployee;
use Al\AppBundle\Form\EmployeeType;
use Al\Application\Employee\Command\HireEmployee;
use Al\Infrastructure\Employee\Criteria\SearchCriteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/employee", name="employee_list")
     */
    public function listAction(Request $request)
    {
        $searchCriteria = new SearchCriteria(
            $request->get('name'),
            $request->get('position'),
            (bool) $request->get('is_fired', false)
        );

        $paginatedEmployees = $this->get('al.employee.repository')->match($searchCriteria);
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
        $form = $this->createForm(EmployeeType::class, new HireEmployee());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var HireEmployee $employeeCommand */
            $employeeCommand = $form->getData();

            try {
                $this->get('command_bus')->handle($employeeCommand);
            } catch (\Exception $e) {
                $this->addFlash('negative', 'An error occurs, please contact an administrator');
            }

            return $this->redirectToRoute('employee_list');
        }

        return $this->render('employee/hire.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/employee/{employeeId}/promote", name="employee_promote")
     */
    public function promoteAction($employeeId, Request $request)
    {
        $form = $this->createForm(EmployeeType::class, new PromoteEmployee($employeeId));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var PromoteEmployee $promotion */
            $promotionCommand = $form->getData();

            try {
                $this->get('command_bus')->handle($promotionCommand);
            } catch (\Exception $e) {
                $this->addFlash('negative', 'An error occurs, please contact an administrator');
            }

            return $this->redirectToRoute('employee_list');
        }

        return $this->render('employee/promote.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/employee/{employeeId}/fire", name="employee_fire")
     */
    public function fireAction($employeeId, Request $request)
    {
        $form = $this->createForm(EmployeeType::class, new FireEmployee($employeeId));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var FireEmployee $firing */
            $firingCommand = $form->getData();

            try {
                $this->get('command_bus')->handle($firingCommand);
            } catch (\Exception $e) {
                $this->addFlash('negative', 'An error occurs, please contact an administrator');
            }

            return $this->redirectToRoute('employee_list');
        }

        return $this->render('employee/fire.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
