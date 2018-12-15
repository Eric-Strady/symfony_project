<?php

namespace Louvre\BookingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('date', DateType::class, array('format' => 'dd / MM / yyyy', 'data' => new \DateTime()))
            ->add('email', EmailType::class)
            ->add('quantity', IntegerType::class)
            ->add('bookings', CollectionType::class, array(
                'entry_type' => BookingType::class,
                'allow_add' => true,
                'allow_delete' => true))
            ->add('reserver',SubmitType::class);
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
