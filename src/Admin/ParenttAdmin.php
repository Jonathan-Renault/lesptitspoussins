<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

final class ParenttAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('nom');
        $formMapper->add('prenom');
        $formMapper->add('mail');
        $formMapper->add('adresse');
        $formMapper->add('codepostal');
        $formMapper->add('ville');
        $formMapper->add('telephone');
        $formMapper->add('password');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('id');
        $filter->add('nom');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('id');
        $listMapper->add('nom');
        $listMapper->add('prenom');
        $listMapper->add('mail');
        $listMapper->add('adresse');
        $listMapper->add('codepostal');
        $listMapper->add('ville');
        $listMapper->add('telephone');
        $listMapper->add('created_at');
        $listMapper->add('updated_at');
    }
}