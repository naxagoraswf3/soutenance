<?php
namespace App\Form;

use App\Entity\Commande;
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

class CommandeType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('nom', TextType::class, ["label" => "Nom"]
			)
			->add('prenom', TextType::class, ["label" => "Prénom"])
			->add('mail', EmailType::class, ["label" => "Adresse mail"])
			->add('Polymere')
			->add('Methode')
			->add('Masterbatch', ChoiceType::class, [
				"choices" => $this->getChoices(),
				"expanded" => true,
				"multiple" => false,
			])
			->add('MFI')
			->add('Quantite')
			->add('Complement')
			->add('fonction', EntityType::class, [
				"class" => Fonction::class,
				"choice_label" => "name",
				"multiple" => true,
				"expanded" => false,
				"help" => "Cliquer pour commencer la sélection",
				"attr" => array('style' => 'width:100%'),
			])

			//champ d'imput caché qui apparaît sur le clic du bouton d'autre fonction
			->add('autrefonction', HiddenType::class)

			//Je crée le champ pour le captcha en utilisant l'ID marqué sur captcha.php et je renvoi un erreur si le captcha est pas valide
			->add('captchaCode', CaptchaType::class, [
				'captchaConfig' => 'ValidationForm',
				'constraints' => [
					new ValidCaptcha([
						'message' => 'captcha invalid',
					]),
				],
			])
			//case a cocher pour accepter 
			->add('agreeTerms', CheckboxType::class, [
				'mapped' => false,
				'constraints' => [
					new IsTrue([
						'message' => 'Vous devez accepter les conditions.',
					]),
				],
			])

		;

	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
			'data_class' => Commande::class,
		]);
	}
	private function getChoices() {
		$choices = Commande::MASTERBATCH;
		$output = [];
		foreach ($choices as $k => $v) {
			$output[$v] = $k;
		}

		return $output;
	}
}
