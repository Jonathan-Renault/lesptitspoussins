<?php


namespace App\Form;


use App\Entity\ProProfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProProfilFormType
 * @package App\Form
 */
class ProProfilFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub
        $builder
            ->add('nomEntreprise')
            ->add('adresse')
            ->add('ville')
            ->add('codepostal')
            ->add('nombredeplace')
            ->add('mail')
            ->add('disponibilite', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ]
            ])
            ->add('nombrePersonnel')
            ->add('telephone')
            ->add('avatar', FileType::class, [
                'label' => 'Veuillez ajouter une photo pour votre avatar'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
        $resolver->setDefaults([
            'data_class' => ProProfil::class
        ]);
    }

}