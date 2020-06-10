<?php

namespace App\Form;

use App\DataTransformer\SiteConfigCustomizationTransformer;
use App\Dto\SiteConfigCustomizationDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiteConfigCustomizationFormType extends AbstractType
{
    private $transformer;

    public function __construct(SiteConfigCustomizationTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('primary', TextType::class, [
                'required' => true,
                'label' => 'form.custom.primary',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
            ->add('fontTitle', TextType::class, [
                'required' => true,
                'label' => 'form.custom.fontTitle',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
            ->add('fontBody', TextType::class, [
                'required' => true,
                'label' => 'form.custom.fontBody',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
            ->add('navBackground', TextType::class, [
                'required' => true,
                'label' => 'form.custom.navBackground',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
            ->add('navColor', TextType::class, [
                'required' => true,
                'label' => 'form.custom.navColor',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
            ->add('navIcon', TextType::class, [
                'required' => true,
                'label' => 'form.custom.navIcon',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
            ->add('btnResaleBackground', TextType::class, [
                'required' => true,
                'label' => 'form.custom.btnResaleBackground',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
            ->add('btnRound', TextType::class, [
                'required' => true,
                'label' => 'form.custom.btnRound',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
            ->add('footerBackground', TextType::class, [
                'required' => true,
                'label' => 'form.custom.footerBackground',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
            ->add('footerColor', TextType::class, [
                'required' => true,
                'label' => 'form.custom.footerColor',
                'translation_domain' => 'admin_form_config_customization',
                'row_attr' => ['class' => 'form-group col-xs-6 col-md-3']
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SiteConfigCustomizationDto::class,
            'attr' => ['class' => 'form']
        ]);
    }
}
