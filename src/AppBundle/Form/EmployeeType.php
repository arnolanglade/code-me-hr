<?php

namespace Al\AppBundle\Form;

use Al\Component\Employee\Command\FireEmployee;
use Al\Component\Employee\Command\HireEmployee;
use Al\Component\Employee\Command\PromoteEmployee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class EmployeeType extends AbstractType
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
                $form->add('name');
                $form->add('position');
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
