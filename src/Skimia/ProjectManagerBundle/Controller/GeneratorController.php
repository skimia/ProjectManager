<?php

namespace Skimia\ProjectManagerBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneratorController extends Controller
{
    public function entityAction(Request $request, $id){
        
        $entity = $this->getDoctrine()->getRepository('SkimiaProjectManagerBundle:Entity')->find($id);        
        $result = $this->container->get('spm.generator')->generateEntity($entity);        
        $result = $this->container->get('spm.beautifier')->beautify($result);
        
        return new Response('<pre>' . htmlspecialchars($result) . '</pre>');
    }
}
