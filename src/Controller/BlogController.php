<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Article;
use App\Repository\ArticleRepository;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo,Request $request)
    {
        $articles = $repo->findAll();
        /*
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM App\Entity\Article a";
        $query = $em->createQuery($dql);
        
        //var_dump($query);

        $pagination =$paginator>paginate(
            $query,
            $request->query->getInt('page',1),
            10
         );
        */
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
            // 'articles' => $pagination
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $em = $this->getDoctrine()->getManager();
         
        $query = $em->createQuery('SELECT a.title,a.image,a.createdAt,a.id FROM App\Entity\Article a ORDER BY a.createdAt');
        $query->setMaxResults(10);
        $articles = $query->getResult();

        return $this->render('blog/home.html.twig',[
            'articles' => $articles
        ]);
    }


    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(ArticleRepository $repo,$id)
    {   
         $article = $repo->find($id);

        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }



    

}
