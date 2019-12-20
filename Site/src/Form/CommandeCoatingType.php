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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CommandeCoatingType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('nom', TextType::class, ["label" => "Nom"]
			)
			->add('prenom', TextType::class, ["label" => "Prénom"])
			->add('mail', EmailType::class, ["label" => "Adresse mail"])
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
				'captchaConfig' => 'ValidationForm',
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

class CommandeCoatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // on définit ici les champs qui composeront le formulaire
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('mail')
            // Etant donné que le choix de la résine se fera sous forme de case à cocher, il y a plusieurs paramètres à prendre en compte
            ->add('resine', ChoiceType::class, [
                 // l'on définit ici les choix que nous proposerons à l'utilisateur
                "choices" => [
                    "Aqueuse"=>"Aqueuse",
                    "Solutée"=>"Solutée",
                    "100% extrait sec"=>"100% extrait sec",
                    "Autre"=>"Autre"],
                "multiple" => false // ce paramètre indique que seulement un seul choix est possible
            ])
            ->add('application')
            ->add('formulation', ChoiceType::class, [
                "choices" => [
                    "Formulation à 100%"=>"Formulation à 100%",
                    "Slurry concentré à diluer"=>"Slurry concentré à diluer"],
                "expanded" => true, // ce paramètre fait que l'on passe d'une liste déroulante à deux cases à cocher
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
            ->add('quantite', IntegerType::class,[
                "attr"=>[
                "min" =>0
                ],
            ])
            ->add('complement')
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
            ]);
            
    }

		return $output;
	}
}