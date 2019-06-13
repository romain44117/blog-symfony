<?php

namespace App\DataFixtures;


use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use App\Entity\User;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;



class ArticleFixtures extends  Fixture implements DependentFixtureInterface
{
/**
* @var Slugify
*/
private $slugify;

/**
* AppFixtures constructor.
* @param Slugify $slugify
*/
    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;

    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {

    }
}
