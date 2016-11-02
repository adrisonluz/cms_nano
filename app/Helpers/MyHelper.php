<?php
/**
* Função para gerar url amigável
*/
if (! function_exists('setUri')) {

  function setUri($string){
    $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($a), $b);
		$string = strip_tags(trim($string));
		$string = str_replace(" ","-",$string);
		$string = str_replace(array("-----","----","---","--"),"-",$string);
		return strtolower(utf8_encode($string));
  }
}

/**
* Função para gerar resumos
*/
if (! function_exists('lmWord')) {
  function lmWord($string, $words = '100'){
    $string 	= strip_tags($string);
    $count		= strlen($string);

    if($count <= $words){
      return $string;
    }else{
      $strpos = strrpos(substr($string,0,$words),' ');
      return substr($string,0,$strpos).' ...';
    }

  }
}
