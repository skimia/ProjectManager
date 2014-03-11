<?php

namespace Skimia\ProjectManagerBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneratorController extends Controller
{
    public function entityAction(Request $request){
        
        $entity = $this->getDoctrine()->getRepository('SkimiaProjectManagerBundle:Entity')->find(1);
        
        $result = $this->container->get('spm.generator')->generateEntity($entity);
        
        return new Response('<pre>' . htmlspecialchars($result) . '</pre>');
    }
}
