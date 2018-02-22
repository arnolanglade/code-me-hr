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

namespace Al\Infrastructure\Framework;

use Al\Domain\Event\EmployeeFired;
use Al\Domain\Event\EmployeeHired;
use Al\Domain\Event\EmployeePromoted;
use Symfony\Component\HttpFoundation\Session\Session;

final class FlashMessageSubscriber
{
    /** @var Session */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param EmployeeHired $event
     */
    public function sendHiredFlashMassage(EmployeeHired $event)
    {
        $this->sendFlashMessage(
            sprintf('%s joins your company as %s!', $event->getEmployeeName(), $event->getEmployeePosition())
        );
    }

    /**
     * @param EmployeePromoted $event
     */
    public function sendPromotedFlashMassage(EmployeePromoted $event)
    {
        $this->sendFlashMessage(
            sprintf('%s has been successfully promoted to %s!', $event->getEmployeeName(), $event->getEmployeePosition())
        );
    }

    /**
     * @param EmployeeFired $event
     */
    public function sendFiredFlashMassage(EmployeeFired $event)
    {
        $this->sendFlashMessage(
            sprintf('%s (Dev) has been successfully fired!', $event->getEmployeeName(), $event->getEmployeePosition())
        );
    }

    /**
     * @param string $message
     */
    private function sendFlashMessage(string $message)
    {
        $this->session->getFlashBag()->add('success', $message);
    }
}
