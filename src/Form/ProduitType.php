<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class,[
                "label" => "Référence n°",
                "constraints" => [
                    new Length([
                        "max" => 20,
                        "maxMessage" => "La réference ne doit pas depasser 20 carecteres",
                        "min" => 5,
                        "minMessage" => "La réference doit comporter au moins 5 caracteres"
                    ])
                  

                ]
            ] )

            ->add('categorie',TextType::class,[
                "label" => "Categorie"
            ])
            ->add('titre')
            ->add('description')
            ->add('photo',FileType::class,[
                /*L'option 'mapped' avec la valeur 'false' signifie que le champ du formulaire ne doit pas etre lié a une propiete de l'objet utilisé pour generer le formulaire
                La valeur de la propriete 'photo' de l'objet ne sera donc pas modifié automatiquement par le formulaire
                 */
                "mapped" => false,
                "required" => false,
                "constraints" =>[
                    new File([
                        "mimeTypes" => [ "image/gif" ,"image/jpeg","image/png" ],
                        "mimeTypesMessage" => "Les formats autorisés sont gif , jpg , png",
                        "maxSize"          =>"2048k",
                        "maxSizeMessage"   =>"Le fichier ne peut pas peser plus de 2Mo"

                    ])
                ]
            ])
            ->add('prix')
            ->add('stock')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
