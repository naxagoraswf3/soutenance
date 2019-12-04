<?php

namespace App\Form;

use App\Entity\CommandeCoating;
use App\Entity\Fonction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeCoatingType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('nom')
			->add('prenom')
			->add('mail')
			->add('resine', ChoiceType::class, [
				"choices" => [
					"Aqueuse" => "Aqueuse",
					"Solutée" => "Solutée",
					"100%" => "100%",
					"Autre" => "Autre"],
				"multiple" => false,
			])
			->add('application')
			->add('formulation', ChoiceType::class, [
				"choices" => [
					"Formulation à 100%" => "Formulation à 100%",
					"Slurry concentré à diluer" => "Slurry concentré à diluer"],
				"expanded" => true,
				"multiple" => false,
			])
			->add('provenance', ChoiceType::class, [
				"choices" => [
					"Formulation dans résine fournie" => "Formulation dans résine fournie",
					"Résine Naxagoras comaptible" => "Résine Naxagoras comaptible",
				],
				"expanded" => true,
				"multiple" => false,
			])
			->add('quantite')
			->add('complement')
			->add('fonction', EntityType::class, [
				"class" => Fonction::class,
				"choice_label" => "name",
				"multiple" => true,
				"expanded" => false,
				"help" => "Cliquer pour commencer la sélection",
			])
		;
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
			'data_class' => CommandeCoating::class,
		]);
	}
}