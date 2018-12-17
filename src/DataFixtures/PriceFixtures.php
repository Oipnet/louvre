<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 06/12/18
 * Time: 14:50
 */

namespace App\DataFixtures;


use App\Entity\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PriceFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $price = new Price();
        $price->setAmount(1200);
        $price->setLabel('Tarif Normal');
        $manager->persist($price);

        $price = new Price();
        $price->setAmount(800);
        $price->setLabel('Tarif Enfant');
        $manager->persist($price);

        $price = new Price();
        $price->setAmount(1200);
        $price->setLabel('Tarif Senior');
        $manager->persist($price);

        $price = new Price();
        $price->setAmount(1000);
        $price->setLabel('Tarif Reduit');
        $manager->persist($price);

        $manager->flush();
    }
}