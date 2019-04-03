<?php


namespace App\Admin;


use App\Entity\EnfantProfil;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EnfantProfilAdmin extends AbstractAdmin
{

    public function toString($object)
    {
        return parent::toString($object); // TODO: Change the autogenerated stub
        return $object instanceof EnfantProfil
            ? $object->getPrenom
            : 'Prénom';
    }

    protected function configureFormFields(FormMapper $form)
    {
        parent::configureFormFields($form); // TODO: Change the autogenerated stub
        $form
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance')
            ->add('allergie')
            ->add('traitement')
            ->add('maladies')
            ->add('autres')
        ;
    }

    protected function configureListFields(ListMapper $list)
    {
        parent::configureListFields($list); // TODO: Change the autogenerated stub
        $list
            ->addIdentifier('nom')
            ->add('prenom')
            ->add('date_naissance')
            ->add('allergie')
            ->add('traitement')
            ->add('maladies')
            ->add('autres')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        parent::configureDatagridFilters($filter); // TODO: Change the autogenerated stub
        $filter
            ->add('nom')
            ->add('maladies')
            ->add('traitement')
            ->add('allergie')
        ;
    }

}