<?php

namespace Skimia\ProjectManagerBundle\Service;

use Skimia\ProjectManagerBundle\Entity\Entity;
use Symfony\Bundle\TwigBundle\TwigEngine;

class Generator {
    
    /** @var TwigEngine **/
    private $twig;

    public function __construct(TwigEngine $twig) {
        $this->twig = $twig;
    }

    /**
     * Génère une entité en utilisant les entités: Entity,Field,ORM et Assert.
     * @param Entity $entity
     * @return string $fileText
     */
    public function generateEntity(Entity $entity) {

        $fileText = $this->twig->render('SkimiaProjectManagerBundle:Generator:Entity/entity.php.twig',
                array(
                    'entity' => $entity
                ));

        return $fileText;
    }

}
