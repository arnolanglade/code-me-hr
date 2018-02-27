<?php
declare(strict_types=1);

/*
 * This file is part of the AL labs package
 *
 * (c) Arnaud Langlade
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Al\ResourceManagement\Infrastructure\UserInterface\Web;

use Al\ResourceManagement\Application\Command\FireEmployee;
use Al\ResourceManagement\Application\Command\HireEmployee;
use Al\ResourceManagement\Application\Command\PromoteEmployee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EmployeeController extends Controller
{
    public function listAction(Request $request)
    {
        $employees = $this->get('al.employee.query')->findAll(
            (int) $request->get('page', 1),
            (int) $request->get('limit', 10)
        );

        return $this->render('employee/list.html.twig', [
            'employees' => $employees
        ]);
    }

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
