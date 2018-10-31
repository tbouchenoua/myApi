<?php

namespace App\Controller;

use App\Document\Car;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CarController extends  Controller
{

    public function showCarAction(Request $request)
    {
        
        $data = $request->getContent();
        $methode=$request->getMethod() ;
        try {
             if ($methode === 'GET') {
                $listeCar = array();
                $cars= $this->get('doctrine_mongodb')->getRepository('App:Car')->findAll();
                foreach ($cars as $key => $value) {
                   
                    $id = $value->getId();
                    $listeCar[$id]["brand"] = $value->getBrand();
                    $listeCar[$id]["model"] = $value->getModel();
                    $listeCar[$id]["value"] = $value->getValue();

                }
                
                $data = $this->get('jms_serializer')->serialize($listeCar, 'json');

                $response = new Response($data);
                $response->headers->set('Content-Type', 'application/json');

                return $response;
            }else if ($methode === 'POST') {

                $car = $this->get('jms_serializer')->deserialize($data, 'App\Document\Car', 'json');

                $dm =  $this->get('doctrine_mongodb')->getManager();
                $dm->persist($car);
                $dm->flush();

               
               $car = $this->get('doctrine_mongodb')->getRepository("UserBundle:Car")->findOneBy(array("id" => $car->getId()));
               $retour["car"]["id"]=$car->getId();
               $retour["car"]["brand"]=$car->getBrand();
               $retour["car"]["model"]=$car->getModel();
               $retour["car"]["value"]=$car->gatValue();
                return new Response(json_encode($retour), Response::HTTP_CREATED);
            }
            else{
                   
                 return new Response("Aucune opération n'est éffectuée", Response::HTTP_CREATED);
            }
            
        } catch (Exception $e) {
             return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR); 
        }
       
       
    }

}