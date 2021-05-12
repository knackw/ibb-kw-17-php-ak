<?php

declare (strict_types=1);

require_once 'inc/tools.inc.php';


class FirstPage extends Page {
    
    public function __construct() {
        //                  $title      $headline
        parent::__construct('Die Page', 'Eine Seitenüberschrift');
    }
    
    protected function viewContent() {
        echo 'der Seiten-Inhalt', BRNL;
    }

}

(new FirstPage())->view();
