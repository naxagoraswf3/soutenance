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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // on définit ici les champs qui composeront le formulaire
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Mail')
            ->add('Polymere')
            ->add('Methode')
            // Etant donné que le choix de la Masterbatch se fera sous forme de case à cocher, il y a plusieurs paramètres à prendre en compte
            ->add('Masterbatch', ChoiceType::class, [
                // l'on définit ici les choix que nous proposerons à l'utilisateur
                "choices" => [
                    "Masterbatch compatible accepté"=>"Masterbatch compatible accepté",
                    "Masterbatch dans la matière de référence"=>"Masterbatch dans la matière de référence"],
                "expanded" => true, // ce paramètre fait que l'on passe d'une liste déroulante à deux cases à cocher
                "multiple" => false // ce paramètre indique que seulement un seul choix est possible
            ])
            ->add('MFI', IntegerType::class,[
                "attr"=>[
                "min" =>0
                ],
            ])
            ->add('Quantite', IntegerType::class,[
                "attr"=>[
                "min" =>0
                ],
            ])
            ->add('Complement')
            ->add('fonction', EntityType::class,[
                // on appelle ici l'entité fonction, dans laquelle les informations rentrées s'afficheront dans une liste déroulante
                "class" => Fonction::class,
                "choice_label"=>"name", // s'affichera dans la liste le nom de chaque fonction
                "multiple" => true, // ce paramètre indique que plusieurs choix sont possibles dans la sélection
                "help" => "Cliquer pour commencer la sélection" // petit message indiquant à l'utilisateur comment procéder au choix de sa fonction
            ])

            // ce champ restera caché sous certaines conditions
            ->add('autrefonction', HiddenType::class)
            
            // l'utilisateur devra accepter les termes d'utilisation avant de confirmer l'envoi de son formulaire
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => "Vous devez accepter les conditions d'utilisation.", // sinon ce message s'affichera
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
}
