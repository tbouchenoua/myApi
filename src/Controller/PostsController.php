<?php

namespace App\Controller;

use App\Document\Product;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends  Controller
{

    public function addDocAction()
    {
      $product = new Product();
      $product->setName('A Foo Bar');
      $product->setPrice('19.99');

      $dm = $this->get('doctrine_mongodb')->getManager();
      $dm->persist($product);
      $dm->flush();

      return new Response('Created product id '.$product->getId());
    }


}