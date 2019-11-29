<?php

namespace App\Form;

use App\Entity\CommandeCoating;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Fonction;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CommandeCoatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            ->add('resine', ChoiceType::class, [
                "choices" => $this->getChoices(),
                "expanded" => true,
                "multiple" => false
            ])
            ->add('application')
            ->add('formulation', ChoiceType::class, [
                "choices" => $this->getChoices(),
                "expanded" => true,
                "multiple" => false
            ])
            ->add('provenance', ChoiceType::class, [
                "choices" => $this->getChoices2(),
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
                "help" => "Choisissez une ou plusieurs options"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommandeCoating::class,
        ]);
    }

    private function getChoices(){
        $choices = CommandeCoating::RESINE;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] =$k;
        }

        return $output;
    }

       private function getChoices2(){
        $choices = CommandeCoating::FORMULATION;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] =$k;
        }

        return $output;
    }

       private function getChoices3(){
        $choices = CommandeCoating::PROVENANCE;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] =$k;
        }

        return $output;
    }
}
