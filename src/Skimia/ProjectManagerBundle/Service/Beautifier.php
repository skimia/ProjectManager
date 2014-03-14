<?php

namespace Skimia\ProjectManagerBundle\Service;

require_once 'PHP_Beautifier/Beautifier.php';

class Beautifier {
    
    public function beautify($code){
        
        $beautifier = new \PHP_Beautifier(); 
        $beautifier->addFilter('NewLines', array(
            'before' => 'namespace:if:return',
            'after' => 'namespace:T_DOC_COMMENT'
        ));
        $beautifier->setInputString($code);
        $beautifier->process();
        return $beautifier->get();
    }
    
}

