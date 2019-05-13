<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Thomas',
        ]);
    }
    /**
     * @Route("/blog/show/{slug?Article Sans Titre}", name="blog_show",
     *  requirements={"slug"="^[a-z0-9]+(?:-[a-z0-9]+)*$"})
     */
    public function show(string $slug): Response
    {
       $slugg = str_replace("-", " ",$slug);
        $newSlug = ucfirst($slugg);
        return $this->render('show.html.twig',['slug' => $newSlug]);
    }
}