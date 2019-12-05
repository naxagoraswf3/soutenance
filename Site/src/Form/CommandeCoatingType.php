<?php
namespace App\Form;

use App\Entity\CommandeCoating;
use App\Entity\Fonction;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class CommandeCoatingType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('Nom', TextType::class, ["label" => "Nom"]
			)
			->add('Prenom', TextType::class, ["label" => "Prénom"])
			->add('Mail', EmailType::class, ["label" => "Adresse mail"])
			->add('resine', ChoiceType::class, [
				"choices" => $this->getChoices(),
				"multiple" => false,
				"expanded" => false,
				"attr" => array('style' => 'width:100%'),

			])
			->add('application')
			->add('formulation', ChoiceType::class, [
				"choices" => $this->getChoices2(),
				"expanded" => true,
				"multiple" => false,
			])
			->add('provenance', ChoiceType::class, [
				"choices" => $this->getChoices3(),
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
				"attr" => array('style' => 'width:100%'),
			])

			->add('autrefonction', HiddenType::class)
			->add('captchaCode', CaptchaType::class, [
				'captchaConfig' => 'formCaptcha',
				'constraints' => [
					new ValidCaptcha([
						'message' => 'invalid captcha',
					]),
				],
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

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
			'data_class' => CommandeCoating::class,
		]);
	}

	private function getChoices() {
		$choices = CommandeCoating::RESINE;
		$output = [];
		foreach ($choices as $k => $v) {
			$output[$v] = $k;
		}

		return $output;
	}

	private function getChoices2() {
		$choices = CommandeCoating::FORMULATION;
		$output = [];
		foreach ($choices as $k => $v) {
			$output[$v] = $k;
		}

		return $output;
	}

	private function getChoices3() {
		$choices = CommandeCoating::PROVENANCE;
		$output = [];
		foreach ($choices as $k => $v) {
			$output[$v] = $k;
		}

		return $output;
	}
}