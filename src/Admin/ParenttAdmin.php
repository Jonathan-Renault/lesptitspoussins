<?php


namespace App\Admin;



use App\Entity\EnfantProfil;
use App\Entity\Parentt;
use App\Entity\Tuteur;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ParenttAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Parentt
            ? $object->getMail()
            : 'Parent';
    }

    protected function configureFormFields(FormMapper $form)
    {

        $form
            ->add('nom')
            ->add('prenom')
            ->add('mail', EmailType::class)
            ->add('ville')
            ->add('codepostal', null, [
                'label' => 'Code Postal'
            ])
            ->add('adresse', null, [
                'label' => 'Votre Adresse Postal'
            ])
            ->add('enfant', ModelType::class, [
                'class' => EnfantProfil::class,
                'label' => 'Vos Enfants',
                'property' => 'nom',
                'multiple' => true,
                'btn_add' => 'Ajouter',
            ])
            ->add('tuteur', ModelType::class, [
                'class' => Tuteur::class,
                'label' => 'Vos différents tuteurs',
                'property' => 'prenom',
                'multiple' => true,
                'sortable' =>true,
                'btn_add' => 'Ajouter',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Votre Mot de Passe'
            ])
            ->add('is_enabled', null, [
                'label' => 'Actif'
            ])
        ;
    }



    public function prePersist($object)
    {
        foreach ($object->getEnfant() as $reponse){
            $reponse->setParentt($object);
        }

        foreach ($object->getTuteur() as $reponse){
            $reponse->setParentt($object);
        }
    }

    public function preUpdate($object)
    {
        foreach ($object->getEnfant() as $reponse){
            $reponse->setParentt($object);
        }

        foreach ($object->getTuteur() as $reponse){
            $reponse->setParentt($object);
        }
    }

    protected function configureListFields(ListMapper $list)
    {
        parent::configureListFields($list); // TODO: Change the autogenerated stub
        $list
            ->addIdentifier('nom', null, [
                'route' => [
                    'name' => 'show'
                ]
            ])
            ->add('prenom')
            ->addIdentifier('mail')
            ->add('ville')
            ->add('codepostal', null, [
                'label' => 'Votre Code Postal'
            ])
            ->add('adresse', null, [
                'label' => 'Votre Adresse Postal'
            ])
            ->add('enfant', null, [
                'associated_property' => 'nom',
                'label' => 'Vos Enfants'
            ])
            ->add('tuteur', null, [
                'associated_property' => 'prenom',
                'label' => 'Vos Tuteurs'
            ])
            ->add('created_at_abonnement', null, [
                'label' => 'Date de création de votre abonnement'
            ])
            ->add('status_abonnement', 'boolean')
            ->add('date_duree', null, [
                'label' => 'Date de Fin de votre abonnement'
            ])
            ->add('is_enabled', 'boolean', [
                'label' => 'Actif'
            ])
            ->add('_action', 'action', [
                'actions' => [
                    'edit' => [],
                    'delete' => []
                ]
            ])
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {

        parent::configureDatagridFilters($filter); // TODO: Change the autogenerated stub
        $filter
            ->add('nom')
            ->add('ville')
            ->add('codepostal', null,[
                'label' => 'Code Postal'
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show)
    {
        parent::configureShowFields($show); // TODO: Change the autogenerated stub
        $show
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('ville')
            ->add('codepostal', null, [
                'label' => 'Votre Code Postal'
            ])
            ->add('adresse', null, [
                'label' => 'Votre Adresse Postal'
            ])
            ->add('enfant', null, [
                'associated_property' => 'nom',
                'label' => 'Vos Enfants'
            ])
            ->add('tuteur', null, [
                'associated_property' => 'prenom',
                'label' => 'Vos Tuteurs'
            ])
            ->add('created_at_abonnement', null, [
                'label' => 'Date de création de votre abonnement'
            ])
            ->add('status_abonnement', 'boolean')
            ->add('date_duree', null, [
                'label' => 'Date de Fin de votre abonnement'
            ])
            ->add('created_at', null, [
                'label' => 'Date de Création de votre compte'
            ])
            ->add('updated_at', null, [
                'label' => 'Date de dernière modification'
            ])
            ->add('is_enabled', 'boolean', [
                'label' => 'Actif'
            ])
        ;
    }


}