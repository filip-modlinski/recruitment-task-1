<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductType
 * @package App\Form
 */
class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productName', TextType::class, [
                'attr' => ['autofocus' => true],
                'label' => 'Nazwa produktu',
            ])
            ->add('codeName', TextType::class, [
                'label' => 'Nazwa kodowa',
            ])
            ->add('productCode', TextType::class, [
                'label' => 'Kod produktu',
                'required' => false,
            ])
            ->add('unitPrice', MoneyType::class, [
                'currency' => 'PLN',
                'divisor' => 100,
                'label' => 'Cena jednostkowa ',
            ])
            ->add('productDescription', TextareaType::class, [
                'attr' => ['rows' => 20],
                'label' => 'Opis produktu',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'category',
                'label' => 'Kategoria',
            ])
            ->add('Wyczyść formularz', ResetType::class)
            ->add('Utwórz produkt', SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
