<?php

declare (strict_types=1);

// Diese Klasse repräsentiert eine Seite
abstract class Page {
    
    private string $title;
    private string $headline;
    
    protected function __construct(string $title, string $headline) {
        $this->title = $title;
        $this->headline = $headline;
    }

    public function view() {
        $this->init();
        
        $this->viewHeader();
        $this->viewNavigation();
//        try {
            $this->viewContent();
//        } catch (Exception $ex) {
//            echo 'smthng wrng', BRNL;
//        }
        $this->viewFooter();
    }
    
    protected function init(): void {}
    
    private function viewHeader() {
        $title = $this->title;
        $headline = $this->headline;
        include 'html/header.html.php';
    }
    
    private function viewNavigation() {
        include 'html/navigation.html.php';
    }
    
    protected abstract function viewContent();
            
    private function viewFooter() {
        include 'html/footer.html.php';
    }
}