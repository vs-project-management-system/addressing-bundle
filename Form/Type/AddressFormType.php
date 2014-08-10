<?php
namespace PMS\Bundle\AddressingBundle\Form\Type;

use \Symfony\Component\Form\FormBuilderInterface;
use \Symfony\Component\OptionsResolver\Options;

class AddressFormType extends \Symfony\Component\Form\AbstractType
{
    /**
     * Data class
     * @var string
     */
    protected $dataClass;

    /**
     * @var EventSubscriberInterface
     */
    protected $eventListener;

    /**
     * Constructor
     * @param string                   $dataClass
     * @param string[]                 $validationGroups
     * @param EventSubscriberInterface $eventListener
     */
    public function __construct(
        $dataClass,
        \Symfony\Component\EventDispatcher\EventSubscriberInterface $eventListener
    ) {
        $this->dataClass = $dataClass;
        $this->eventListener = $eventListener;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber($this->eventListener)
            ->add(
                'firstName',
                'text',
                array('label' => 'first name')
            )
            ->add(
                'lastName',
                'text',
                array('label' => 'last name')
            )
            ->add(
                'company',
                'text',
                array(
                    'required' => false,
                    'label'    => 'company'
                )
            )
            ->add(
                'country',
                'country',
                array(
                    'label' => 'choose a country',
                    'empty_value' => false
                )
            )
            ->add(
                'street',
                'text',
                array('label' => 'street')
            )
            ->add(
                'city',
                'text',
                array('label' => 'city')
            )
            ->add(
                'postcode',
                'text',
                array('label' => 'postal code')
            );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(
                array(
                    'data_class' => $this->dataClass
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'address';
    }
}
