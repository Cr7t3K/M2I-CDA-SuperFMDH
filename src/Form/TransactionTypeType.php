<?php

namespace App\Form;

use App\Entity\PropertyType;
use App\Entity\TransactionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Title',
                'required' => true,
                'label_attr' => [
                    'class' => 'block text-gray-700 text-sm font-bold mb-2',
                ],
                'attr' => [
                    'class' => 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 
                    leading-tight focus:outline-none focus:shadow-outline'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TransactionType::class,
        ]);
    }
}
