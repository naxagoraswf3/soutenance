<?php

namespace App\Form;


use App\Entity\Fonction;
use App\Entity\CommandeCoating;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;




class CommandeCoatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('resine', ChoiceType::class, [
                "choices" => [
                    "Aqueuse"=>"Aqueuse",
                    "Solutée"=>"Solutée",
                    "100% extrait sec"=>"100% extrait sec",
                    "Autre"=>"Autre"],
                "multiple" => false
            ])
            ->add('application')
            ->add('formulation', ChoiceType::class, [
                "choices" => [
                    "Formulation à 100%"=>"Formulation à 100%",
                    "Slurry concentré à diluer"=>"Slurry concentré à diluer"],
                "expanded" => true,
                "multiple" => false
            ])
            ->add('provenance', ChoiceType::class, [
                "choices" => [
                    "Formulation dans résine fournie"=>"Formulation dans résine fournie",
                    "Résine Naxagoras compatible"=>"Résine Naxagoras compatible"
                ],
                "expanded" => true,
                "multiple" => false
            ])
            ->add('quantite')
            ->add('complement')
            ->add('fonction', EntityType::class,[
                "class" => Fonction::class,
                "choice_label"=>"name",
                "multiple" => true,
                "expanded" => false,
                "help" => "Cliquer pour commencer la sélection"
            ])

            ->add('autrefonction', HiddenType::class)
            
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeCoating::class,
        ]);
    }
}
