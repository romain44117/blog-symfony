<?php


namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

class CategoryContoller extends AbstractController
{


    /**
     * @Route("/category", name="category_index")
     * @return Response A response instance
     */
    public function addCategory( Request $request, EntityManagerInterface $entityManager ) : Response
    {
        $category = new Category();
        $form= $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $entityManager->persist($category);
            $entityManager->flush();
        }

        return $this->render(
            'category/index.html.twig',
            ['category' => $category,
                'form' => $form->createView(),

            ]);
    }


}
