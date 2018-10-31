<?php

namespace App\Controller;

use App\Document\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends  Controller
{
         
    public function showAction(Request $request,$identifiant)
    {
        
        $data = $request->getContent();
        $methode=$request->getMethod() ;
        try {
             // test de la métode 
            if ($methode === 'GET') {
               
                $listeUser = array();
                $dm = $this->get('doctrine_mongodb')->getManager();
                // recuperation de tous les utilisateur existants
                $users= $this->get('doctrine_mongodb')->getRepository('App:User')->findAll();
                foreach ($users as $key => $value) {
                    $id = $value->getId();
                    $listeUser[$id]["age"] = $value->getAge();
                    $listeUser[$id]["balance"] = $value->getBalance();
                    $listeUser[$id]["lastname"] = $value->getLastname();
                    $listeUser[$id]["firsname"] = $value->getFirstname();
                    $listeUser[$id]["cars"] = $value->getCars();

                }
                
                $data = $this->get('jms_serializer')->serialize($listeUser, 'json');

                $response = new Response($data,Response::HTTP_OK);
                $response->headers->set('Content-Type', 'application/json');
                $response->headers->set('Location', '/api/users');
                return $response;

            }else if ($methode === 'POST') {
                // intilaisation de l'utilisateur a créé  
                $user = $this->get('jms_serializer')->deserialize($data, 'App\Document\User', 'json');
                $dm = $this->get('doctrine_mongodb')->getManager();
                $dm->persist($user);
                $dm->flush();

               // recuperation des informations de l'utilisateur créé.
               $user = $this->get('doctrine_mongodb')->getRepository("App:User")->findOneBy(array("id" => $user->getId()));
               $retour["user"]["id"]=$user->getId();
               $retour["user"]["age"]=$user->getAge();
               $retour["user"]["balance"]=$user->getBalance();
               $retour["user"]["lastname"]=$user->getLastname();
               $retour["user"]["firstname"]=$user->getFirstname();
               $retour["user"]["cars"]=$user->getCars();
                
                $response = new Response(json_encode($retour),Response::HTTP_CREATED);
                $response->headers->set('Location', '/api/users');
                return $response;
            }
            else{
                 $dt= $this->get('jms_serializer')->deserialize($data, 'App\Document\User', 'json');
               
                    $dm = $this->get('doctrine_mongodb')->getManager();
                $user = $this->get('doctrine_mongodb')->getRepository("App:User")->findOneBy(array("id" => $identifiant));
               // maj de l'utilsateur selectionné
                if ($user) {
                    $retour["age"]=$dt->getAge();
                    $retour["balance"]=$dt->getBalance();
                    $retour["lastname"]=$dt->getLastname();
                    $retour["firstname"]=$dt->getFirstname();
                    $retour["cars"]=$dt->getCars();
                    $user->setAge( $retour["age"]);
                    $user->setLastname( $retour["lastname"]);
                    $user->setFirstname( $retour["firstname"]);
                    $user->setBalance( $retour["balance"]);
                    $user->setCars( $retour["cars"]);
                    $dm->persist($user);
                    $dm->flush();
                    $retour["id"]=$user->getId();

                   
                    $response = new Response(json_encode($retour),Response::HTTP_CREATED);
                     $response->headers->set('Content-Type', 'application/json');
                    $response->headers->set('Location', '/api/users');
                 return $response;
                }
                else{
                return new Response("L'utilisateur n'existe pas", Response::HTTP_CREATED);

                }
                         

            }
            
        } catch (Exception $e) {
             return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR); 
        }
       
       
    }

   
}