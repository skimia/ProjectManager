<?php
define('WEB_DIRECTORY', __DIR__);
/**
   * Affiche des informations à propos d'une variable, de manière à ce qu'elle soit lisible
   * @param mixed expression L'expression à afficher.
   * @param boolean $return Si vous voulez obtenir le résultat de debug() dans une chaîne, utilisez le paramètre return. Lorsque ce paramètre vaut TRUE, debug() retournera l'information plutôt que de l'afficher. 
   * @param integer $max_levels Le maximum de niveaux en cascade a afficher lors du parcours d'un objet ou d'un array
   * @return string Si une chaîne de caractères,un booleen, un entier ou un nombre décimal est fournie, sa valeur sera affichée. Si un tableau est fourni, les valeurs seront affichées dans un format permettant de voir les clés et les éléments. Un format similaire sera également utilisé pour les objets. Lorsque le paramètre return vaut TRUE, cette fonction retournera une chaîne de caractères. Autrement, la valeur de retour sera TRUE. 
   */
 function debug($expression, $return = false, $max_levels = 4){
       ob_start() ;
       echo '<pre >' ;
       do_dump($expression, '$var', NULL, NULL, $max_levels) ;
       echo '</pre>' ;
       $texte = ob_get_clean() ;
       if($return)
            return $texte ;
       echo $texte ;
       return true ;
  }

  /**
   * Fonction de remplacement a Print_r
   * @param type $var
   * @param type $var_name
   * @param type $indent
   * @param string $reference
   * @param type $max_level
   */
  function do_dump(&$var, $var_name = NULL, $indent = NULL, $reference = NULL, $max_level = 5){
       $max_level-- ;
       $do_dump_indent = '<span style="color:#eeeeee;">|</span> &nbsp;&nbsp;' ;
       $reference = $reference . $var_name ;
       $keyvar = 'the_do_dump_recursion_protection_scheme' ;
       $keyname = 'referenced_object_name' ;

       if(is_array($var) && isset($var[$keyvar])){
            $real_var = &$var[$keyvar] ;
            $real_name = &$var[$keyname] ;
            $type = ucfirst(gettype($real_var)) ;
            echo $indent . $var_name . '<span style="color:#a2a2a2">' . $type . '</span> = <span style="color:#e87800;">&amp;' . $real_name . '</span><br>' ;
       } else{
            $var = array($keyvar => $var, $keyname => $reference) ;
            $avar = &$var[$keyvar] ;

            $type = ucfirst(gettype($avar)) ;
            if($type == "String")
                 $type_color = '<span style="color:green">' ;
            elseif($type == "Integer")
                 $type_color = '<span style="color:red">' ;
            elseif($type == "Double"){
                 $type_color = '<span style="color:#0099c5">' ;
                 $type = "Float" ;
            } elseif($type == "Boolean")
                 $type_color = '<span style="color:#92008d">' ;
            elseif($type == "NULL")
                 $type_color = '<span style="color:black">' ;

            if(is_array($avar)){
                 $count = count($avar) ;
                 echo $indent . ($var_name ? $var_name . ' => ' : '') . '<span style="color:#a2a2a2">' . $type . '<i> (size=' . $count . ')</i></span><br>' . $indent . '(<br>' ;
                 $keys = array_keys($avar) ;
                 if(($max_level + 1) < 1){
                      echo $indent . $do_dump_indent . '<b>...</b><br/>' ;
                 } else{
                      if($count > 0)
                           foreach($keys as $name){
                                $value = &$avar[$name] ;
                                if(is_string($name))
                                     $name = '\'' . $name . '\'' ;
                                do_dump($value, "[$name]", $indent . $do_dump_indent, $reference, $max_level) ;
                           }
                      else
                           echo $indent . $do_dump_indent . '<span style="color:#a2a2a2">empty</span><br/>' ;
                 }
                 echo $indent . ')<br>' ;
            }
            elseif(is_object($avar)){
                 echo $indent . $var_name . ' <span style="color:#a2a2a2">' . $type . '&nbsp;' . get_class($avar) . '</span><br>' . $indent . '(<br>' ;
                 if(($max_level + 1) < 1){
                      echo $indent . $do_dump_indent . '<b>...</b><br/>' ;
                 } else{
                      $reflect = new \ReflectionObject($avar) ;
                      $props = $reflect->getProperties() ;
                      foreach($props as $value){
                           if($value->isStatic())
                                $acess = '<span style="color:#a2a2a3">static</span>' ;
                           if($value->isPublic())
                                $acess = '<span style="color:#a2a2a3">public</span>' ;
                           if($value->isPrivate())
                                $acess = '<span style="color:#a2a2a3">private</span>' ;
                           if($value->isProtected())
                                $acess = '<span style="color:#a2a2a3">protected</span>' ;
                           $value->setAccessible(true) ;
                           $varvalue = $value->getValue($avar) ;
                           do_dump($varvalue, $acess . ' ' . $value->getName(), $indent . $do_dump_indent, $reference, $max_level) ;
                      }
                 }
                 echo $indent . ')<br>' ;
            }
            elseif(is_int($avar))
                 echo $indent . $var_name . ' = <span style="color:#a2a2a2">' . $type . '</span> ' . $type_color . $avar . '</span><br>' ;
            elseif(is_string($avar))
                 echo $indent . $var_name . ' = <span style="color:#a2a2a2">' . $type . '</span> ' . $type_color . '\'' . htmlentities($avar) . '\'</span>&nbsp;<i>(length=' . strlen($avar) . ')</i><br>' ;
            elseif(is_float($avar))
                 echo $indent . $var_name . ' = <span style="color:#a2a2a2">' . $type . '</span> ' . $type_color . $avar . '</span><br>' ;
            elseif(is_bool($avar))
                 echo $indent . $var_name . ' = <span style="color:#a2a2a2">' . $type . '</span> ' . $type_color . ($avar == 1 ? "TRUE" : "FALSE") . '</span><br>' ;
            elseif(is_null($avar))
                 echo $indent . $var_name . ' = ' . $type_color . 'NULL</span><br>' ;
            else
                 echo $indent . $var_name . ' = <span style="color:#a2a2a2">' . $type . '</span> ' . $avar . '<br>' ;

            $var = $var[$keyvar] ;
       }
  }
  
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read http://symfony.com/doc/current/book/installation.html#configuration-and-setup for more information
//umask(0000);

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
