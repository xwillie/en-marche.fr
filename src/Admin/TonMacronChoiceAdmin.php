<?php

namespace AppBundle\Admin;

use AppBundle\Entity\TonMacronChoice;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TonMacronChoiceAdmin extends AbstractAdmin
{
    protected $maxPerPage = 200;
    protected $datagridValues = [
        '_page' => 1,
        '_per_page' => 200,
        '_sort_order' => 'ASC',
        '_sort_by' => 'contentKey',
    ];

    public function getTemplate($name)
    {
        if ('list' === $name) {
            return 'admin/ton_macron/choice_list.html.twig';
        }

        return parent::getTemplate($name);
    }

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('contentKey', null, [
                'label' => 'Clé',
            ])
            ->add('label', null, [
                'label' => 'Label',
            ])
            ->add('content', null, [
                'label' => 'Message',
                'attr' => ['rows' => 10],
            ])
            ->add('step', ChoiceType::class, [
                'label' => 'Etape',
                'choices' => TonMacronChoice::STEPS,
                'choice_translation_domain' => 'forms',
            ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('contentKey', null, [
                'label' => 'Clé',
            ])
            ->add('label', null, [
                'label' => 'Label',
            ])
            ->add('content', null, [
                'label' => 'Message',
            ])
            ->add('_action', null, [
                'virtual_field' => true,
                'template' => 'admin/ton_macron/choice_list_actions.html.twig',
            ])
        ;
    }
}
