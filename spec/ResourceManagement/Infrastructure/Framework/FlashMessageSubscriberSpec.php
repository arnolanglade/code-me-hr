<?php

namespace spec\Al\ResourceManagement\Infrastructure\Framework;

use Al\ResourceManagement\Domain\Event\EmployeeFired;
use Al\ResourceManagement\Domain\Event\EmployeeHired;
use Al\ResourceManagement\Domain\Event\EmployeePromoted;
use Al\ResourceManagement\Infrastructure\Framework\FlashMessageSubscriber;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class FlashMessageSubscriberSpec extends ObjectBehavior
{
    function let(Session $session, FlashBagInterface $flashBag)
    {
        $this->beConstructedWith($session);

        $session->getFlashBag()->willReturn($flashBag);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FlashMessageSubscriber::class);
    }

    function it_send_a_notification_to_user_when_a_employee_is_hired($flashBag)
    {
        $event = new EmployeeHired('employe-id', 'Arnaud', 'Dev');

        $flashBag->add('success', 'Arnaud joins your company as Dev!')->shouldBeCalled();

        $this->sendHiredFlashMassage($event)->shouldReturn(null);
    }

    function it_send_a_notification_to_user_when_a_employee_is_promoted($flashBag)
    {
        $event = new EmployeePromoted('employe-id', 'Arnaud', 'Dev');

        $flashBag->add('success', 'Arnaud has been successfully promoted to Dev!')->shouldBeCalled();

        $this->sendPromotedFlashMassage($event)->shouldReturn(null);
    }

    function it_send_a_notification_to_user_when_a_employee_is_fired($flashBag)
    {
        $event = new EmployeeFired('employe-id', 'Pipou', 'Dev');

        $flashBag->add('success', 'Pipou (Dev) has been successfully fired!')->shouldBeCalled();

        $this->sendFiredFlashMassage($event)->shouldReturn(null);
    }
}
