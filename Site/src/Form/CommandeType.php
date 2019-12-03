<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Fonction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class, ["label"=> "Nom"]
            )
            ->add('Prenom', TextType::class, ["label"=> "Prénom"])
            ->add('Mail',EmailType::class, ["label"=> "Adresse mail"])
            ->add('Polymere')
            ->add('Methode')
            ->add('Masterbatch', ChoiceType::class, [
                "choices" => $this->getChoices(),
                "expanded" => true,
                "multiple" => false
            ])
            ->add('MFI')
            ->add('Quantite')
            ->add('Complement')
            ->add('fonction', EntityType::class,[
                "class" => Fonction::class,
                "choice_label"=>"name",
                "multiple" => true,
                "expanded" => false,
                "help" => "Cliquer pour commencer la sélection"
            ])
            ->add('autrefonction', HiddenType::class)
            ->add("captchaCode", CaptchaType::class,[
                'captchaConfig'=> 'ValidationForm',
                'constraints' => [
                    new ValidCaptcha([
                        'message' => 'captcha invalide'
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }

     private function getChoices(){
        $choices = Commande::MASTERBATCH;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] =$k;
        }

        return $output;
    }
}
