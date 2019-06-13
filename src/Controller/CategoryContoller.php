<?php


namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function addCategory( Request $request, EntityManagerInterface $entityManager ) : Response
    {
        $category = new Category();
        $form= $this->createForm(CategoryType::class,$category);
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $entityManager->persist($category);
            $this->addFlash('success', 'The new category has been created');

            $entityManager->flush();
        }

        return $this->render(
            'category/index.html.twig',
            ['category' => $category,
                'form' => $form->createView(),

            ]);
    }
}
