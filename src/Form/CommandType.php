<?php

namespace App\Form;

use App\Entity\Command;
use App\Entity\Ticket;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visitingDay', DateType::class, [
                'html5' => true,
                'widget' => 'single_text',
                'attr' => [
                    'title' => 'qsdfgfsdgs'
                ]
            ])
            ->add('client', ClientType::class)
            ->add('tickets', CollectionType::class, [
                'entry_type' => TicketType::class,
                'allow_add' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
        ]);
    }
}
