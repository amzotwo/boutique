<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produits::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
               TextField::new('nom'),
               SlugField::new('slug')->setTargetFieldName('nom'),
               ImageField::new('illustration')
                   ->setBasePath('uploads/')
                   ->setUploadDir('public/uploads/')
                   ->setUploadedFileNamePattern('[randomhash].[extension]')
                   ->setRequired(false),
               TextField::new('subtitle'),
               BooleanField::new ('isBest'),
               TextareaField::new('description'),
               MoneyField::new('price')->setCurrency('XOF'),
               AssociationField::new('category')
        ];
    }

}
