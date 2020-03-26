<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use App\Requests\DossierRequest;

class DossierType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', IntegerType::class, [
                'label' => 'Номер досье',
                'empty_data' => '000000',
                ])
            ->add('type', TextType::class, [
                'label' => 'Тип досье',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Имя',
                'constraints' => [
                    new NotBlank(),
                ],
                ])
            ->add('surname', TextType::class, [
                'label' => 'Фамилия',
                'constraints' => [
                    new NotBlank(),
                ],
                ])
            ->add('address', TextType::class, [
                'label' => 'Адрес',
            ])
            ->add('card_number', IntegerType::class, [
                'label' => 'Номер карты',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 16, 'max' => 16]),
                ],
                'empty_data' => '00000000000000000000',
            ])
            ->add('card_cvv', IntegerType::class, [
                'label' => 'CVV',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 1]),
                ],
            ])
          ;
    }

    public function validateNumber(DossierRequest $dossierRequest, ExecutionContextInterface $context)
    {
        $entityManager = $this->entityManager;
        $repository = $entityManager->getRepository('App:Dossier');

        if ( ! $dossierRequest->id && count($repository->findBy(['number' => $dossierRequest->number]))) {
            $context->buildViolation('The Dossier with this number already exists')
                ->atPath('number')
                ->addViolation();
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'constraints' => [
                new Callback([$this, 'validateNumber'])
            ]
        ]);
    }
}
