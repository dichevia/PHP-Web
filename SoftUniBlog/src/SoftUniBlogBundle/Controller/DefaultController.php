<?php

namespace SoftUniBlogBundle\Controller;

use SoftUniBlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="blog_index")
     */
    public function index()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([], ['viewCount'=>'DESC', 'dateAdded'=>'DESC']);
        return $this->render('blog/index.html.twig', ['articles' => $articles]);
    }
}
