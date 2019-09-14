<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AnnonceType extends AbstractType
{
    /**
     * Merci d'avoir la configuration de base d'un champ !
     *
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return void
     */
    private function getConfiguration ($label,$placeholder,$options = []){
        return  array_merge([
                'label' => $label,
                'attr'  => [
                    'placeholder' => $placeholder
                    ]
                ],$options);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class,$this->getConfiguration("Titre","Tapez le titre de l'annonce"))
            ->add('slug',TextType::class,$this->getConfiguration("Adresse web","Tapez l'adresse web (automatique)",[
                'required' => false
            ]))
            ->add('coverImage',UrlType::class,$this->getConfiguration("Url de l'image principale","Donnez l'url des images qui donnent vraiment envie de venir chez vous"))
            ->add('introduction',TextType::class,$this->getConfiguration("Introduction","Donnez une description globale de l'annonce"))
            ->add('content',TextareaType::class,$this->getConfiguration("Description","Donnez une description qui donne vraiment envie de venir chez vous"))
            ->add('price',MoneyType::class,$this->getConfiguration("Prix par nuit","Indiquez le prix que vous voulez pour une nuit"))
            ->add('rooms',IntegerType::class, $this->getConfiguration("Nombre de chambre","Indiquez le nombre de chambre disponible"))
            ->add(
                'images',
                CollectionType::class,[
                    'entry_type'   => ImageType::class,
                    'allow_add'    => true,
                    'allow_delete' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
