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
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class EmployeeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $employee = $event->getData();

            if ($employee instanceof HireEmployee) {
                $form = $event->getForm();
                $form->add('name');
                $form->add('position');
                $form->add('salaryScale');
            }

            if ($employee instanceof PromoteEmployee) {
                $form = $event->getForm();
                $form->add('position');
                $form->add('salaryScale');
            }

            if ($employee instanceof FireEmployee) {
                $form = $event->getForm();
                $form->add('firedAt', DateType::class, [
                    'widget' => 'single_text',
                ]);
            }
        });
    }
}
