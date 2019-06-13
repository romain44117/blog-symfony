<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use App\Entity\User;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $slugify;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(Slugify $slugify, UserPasswordEncoderInterface $encoder)
    {
        $this->slugify = $slugify;
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $author = new User();
        $author->setPassword(
            $this->encoder->encodePassword(
                $author,
                'the_new_password'
            ));
        $author->setEmail('author@monsite.com');
        $author->setRoles(['ROLE_AUTHOR']);

        $manager->persist($author);

        for ($i = 1; $i <= 1000; $i++) {
            $category = new Category();
            $category->setName("category " . $i);
            $manager->persist($category);

            $tag = new Tag();
            $tag->setName("tag " . $i);
            $manager->persist($tag);

            $article = new Article();
            $article->setTitle("article " . $i);
            $article->setSlug($this->slugify->generate($article->getTitle()));
            $article->setContent("article " . $i . " content");
            $article->setAuthor($author);
            $article->setCategory($category);
            $article->addTag($tag);
            $manager->persist($article);
        }
        $manager->flush();
    }
}
