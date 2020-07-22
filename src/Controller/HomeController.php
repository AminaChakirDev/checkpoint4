<?php
// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recipe;


class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home_index")
     * @return
     */
    public function index() :Response
    {
        $recipes = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findAll();
        if (!$recipes) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }

        return $this->render(
            'home/index.html.twig',
            ['recipes' => $recipes]
        );
    }

    /**
     * @Route("/home/show/{page}", name="home_show")
     */
    public function show(int $page): Response
    {
        return $this->render('home/show.html.twig', ['page' => $page]);
    }
}