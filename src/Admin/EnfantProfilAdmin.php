<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

final class EnfantProfilAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('nom');
        $form->add('prenom');
        $form->add('date_naissance');
        $form->add('allergie');
        $form->add('traitement');
        $form->add('maladies');
        $form->add('autres');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('nom');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('nom');
        $list->add('prenom');
        $list->add('date_naissance');
        $list->add('allergie');
        $list->add('traitement');
        $list->add('maladies');
        $list->add('autres');
    }
}