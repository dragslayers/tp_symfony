<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Beer;
use App\Entity\Category;

class GenerateController extends AbstractController
{
    /**
     * @Route("/beers/beer", name="beers")
     */
    public function beer(): Response
    {
        $beer = $this->getDoctrine()->getRepository(Beer::class);
        return $this->render('bar/beers/beer.html.twig', [
            'beers_title' => 'The beers',
            'beers' => $beer->findAll(),
            
        ]);
    }

    /**
     * @Route("/newbeer", name="create_beer")
    */
    public function createBeer(){
        $entityManager = $this->getDoctrine()->getManager();

        $beer = new Beer();
        $beer->setname('Super Beer');
        $beer->setPublishedAt(new \DateTime());
        $beer->setDescription('Ergonomic and stylish!');        

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($beer);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new beer with id '.$beer->getId());
    }

    /**
     * @Route("/newcategory", name="create_category")
    */
    public function createCategory(){
        $entityManager = $this->getDoctrine()->getManager();

        $category = new Category();
        $category->setName('brune');
        $category_beer= new Beer();

             

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($category);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new category with id '.$category->getId());
    }
}
