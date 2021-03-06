<?php

namespace SimeonoffBlogBundle\Controller;

use SimeonoffBlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $articles = $this
            ->getDoctrine()
            ->getRepository(Article::class)
            ->findBy([], ['viewCount' => "DESC", 'dateAdded' => "DESC"]);

        return $this->render('blog/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
