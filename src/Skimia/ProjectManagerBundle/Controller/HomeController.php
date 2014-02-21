<?php

namespace Skimia\ProjectManagerBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function homeAction(){
        
        return $this->render('SkimiaProjectManagerBundle::theme.html.twig');
    }
}
