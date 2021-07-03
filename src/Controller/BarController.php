<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\Beer;
use App\Entity\Client;

class BarController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        $beer = $this->getDoctrine()->getRepository(Beer::class);
        return $this->render('bar/index.html.twig', [
            'controller_name' => 'Bar',
            'beers' => $beer->findBy(array(),array('id' => 'DESC'), 3),
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('bar/contact.html.twig', [
            'title_contact' => 'page contact',
        ]);
    }
    /**
     * @Route("/beer", name="showBeer")
     */
    public function showBeer(int $id)
    {
        $beer = $this->getDoctrine()->getRepository(Beer::class);
        return $this->render('bar/beer.html.twig', [
            'beers' => $beer->findBy(array('id' => $id)),
        ]);
    }

    /**
     * @Route("/mention", name="mention")
     */
    public function mention(): Response
    {
        return $this->render('bar/mention.html.twig', [
            'mention_leg' => 'Mentions Légales',
        ]);
    }

    /**
     * @Route("/clients/client", name="clients")
     */
    public function clients(): Response
    {
        $client = $this->getDoctrine()->getRepository(client::class)->findAll();
        return $this->render('bar/clients/client.html.twig', [
            'clients_title' => 'The client',
            'clients' => $client,
            
        ]);
    }
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    private function beers_api(): Array
    {
    $response = $this->client->request(
        'GET',
        'https://raw.githubusercontent.com/Antoine07/hetic_symfony/main/Introduction/Data/beers.json'
    );

    $statusCode = $response->getStatusCode();
    // $statusCode = 200
    $contentType = $response->getHeaders()['content-type'][0];
    // $contentType = 'application/json'
    $content = $response->getContent();
    // $content = '{"id":521583, "name":"symfony-docs", ...}'
    $content = $response->toArray();
    // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
    //dump($content);

    return $content ;
    }
}
