<?php

namespace App\Form;

use App\Entity\SettlingRoom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettlingRoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('SetDate')
            ->add('DepartureDate')
            ->add('RoomNum')
            ->add('PassportNum')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SettlingRoom::class,
        ]);
    }
}
