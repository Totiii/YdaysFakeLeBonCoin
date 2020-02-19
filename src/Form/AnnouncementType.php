<?php

namespace App\Form;

use App\Entity\Announcement;
use App\Entity\Category;
use App\Entity\City;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class,
                ['label' => false]
            )
            ->add('Price', NumberType::class,
                ['label' => false]
            )
            ->add('Description',TextareaType::class,
                ['label' => false]
            )
            ->add('adress', TextType::class,
                ['label' => false]
            )
            ->add('category', EntityType::class,
                [
                    'class' => Category::class,
                    'label' => false
                ]
            )
            ->add('city', EntityType::class,
                [
                    'class' => City::class,
                    'label' => false
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Announcement::class,
        ]);
    }
}
