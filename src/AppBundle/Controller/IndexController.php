<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findAll();


        return $this->render('AppBundle:Index:index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/{category_name}", name="showCategory")
     */
    public function categoryAction(Request $request, $category_name)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Category')->findOneByName($category_name);
        $product = $em->getRepository('AppBundle:Product')->findOneByName('iPhone');

        $category->addProducts($product);

        $em->flush();

        return $this->render('AppBundle:Index:category.html.twig', [
            'category' => $category,
        ]);
    }
}