<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArticleController extends AbstractController
{
    /**
     * @Route ("/", name="numbers")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);
        $chiffre1 = 20;
        $chiffre2 = 2;
        $calc = ($chiffre1 * $chiffre2);


        return $this->render('articles/index.html.twig', [
            'text' => 'Voici mon premier texte',
            'numberRandom' => $number,
            'calc' => $calc,
            'chiffre1' => $chiffre1,
            'chiffre2' => $chiffre2,
        ]);
    }

    /**
     * @Route ("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('articles/index.html.twig', [
            'text' => 'Voici mon premier texte',
            'numberRandom' => 0,
            'calc' => 1,
            'chiffre1' => 2,
            'chiffre2' => 3,
        ]);
    }
}