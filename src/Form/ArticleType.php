<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class'=>'form-control', 
                    'id'=>'title',
                    'name'=>'title' 
                ]
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class'=>'form-control',
                    'id'=>'content',
                    'rows'=>'5' 
                ]  
            ])
            /*->add('image', FileType::class,[ 
                    'attr' => [
                        'class'=>'form-control-file',
                        'id'=>'image'      
                    ],  
                    'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/jpeg',
                            'application/jpg',
                            'application/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid jpeg/png document',
                
                ])*/
            ->add('image', TextType::class, [
                'attr' => [
                    'class'=>'form-control', 
                    'id'=>'image',
                    'name'=>'image' 
                ]
            ])    
            ->add('OK !', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'                        
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
