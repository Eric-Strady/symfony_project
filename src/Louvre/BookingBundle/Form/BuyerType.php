<?php

namespace Louvre\BookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Louvre\BookingBundle\Form\BookingType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BuyerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'html5' => true,
                'format' => 'dd/MM/yyyy'
            ))
            ->add('email', EmailType::class)
            ->add('typeTicket', ChoiceType::class, array(
                'choices' => array(
                    'Billet Journée' => 'BJ',
                    'Billet Demi-Journée' => 'BDJ'
                )))
            ->add('quantity', ChoiceType::class, array(
                'required' => true,
                'choices' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10'=> 10
                )))
            ->add('bookings', CollectionType::class, array(
                'entry_type' => BookingType::class,
                'allow_add' => true,
                'allow_delete' => true))
            ->add('paid',SubmitType::class, array(
                'attr' => array(
                    'class' => 'btn btn-primary')
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\BookingBundle\Entity\Buyer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'louvre_bookingbundle_buyer';
    }


}
