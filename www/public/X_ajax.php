<?php

declare (strict_types=1);
require_once 'inc/tools.inc.php';

class AjaxPage extends Page {
    
    public function __construct() {
        parent::__construct('AJAX', 'Asynchronous Javascript And XML');
    }
    
    protected function viewContent() {

        
        include 'html/ajax.html.php';
        
    }
}

(new AjaxPage())->view();
