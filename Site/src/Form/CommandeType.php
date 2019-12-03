<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Fonction;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Mail')
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
