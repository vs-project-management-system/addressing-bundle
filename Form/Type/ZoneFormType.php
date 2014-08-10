<?php
namespace PMS\Bundle\AddressingBundle\Form\Type;

class ZoneFormType extends \Symfony\Component\Form\AbstractType
{
    const COUNTRY_OPTION_KEY = 'country_field';

    /**
     * {@inheritdoc}
     */
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->setAttribute(self::COUNTRY_OPTION_KEY, $options[self::COUNTRY_OPTION_KEY]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $choices = function (\Symfony\Component\OptionsResolver\Options $options) {
            // show empty list if country is not selected
            if (empty($options['country'])) {
                return array();
            }

            return null;
        };

        $resolver
            ->setDefaults(
                array(
                    'label'         => 'zone',
                    'class'         => 'PMSAddressingBundle:Zone',
                    'random_id'     => true,
                    'property'      => 'name',
                    'query_builder' => null,
                    'choices'       => $choices,
                    'country'       => null,
                    'country_field' => null,
                    'configs' => array(
                        'placeholder' => 'choose a zone',
                        'allowClear' => true
                    ),
                    'empty_value' => '',
                    'empty_data'  => null
                )
            );
    }

    /**
     * {@inheritdoc}
     */
    public function finishView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options)
    {
        $view->vars['country_field'] = $form->getConfig()->getAttribute(self::COUNTRY_OPTION_KEY);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'genemu_jqueryselect2_translatable_entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'zone';
    }
}
