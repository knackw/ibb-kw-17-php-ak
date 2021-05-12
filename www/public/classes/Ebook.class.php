<?php

declare (strict_types=1);

class Ebook extends Book {
    
    private string $format;
    
    function __construct(string $format, string $title) {
        parent::__construct($title);
        $this->format = $format;
    }
    
    public function getFormat(): string {
        return $this->format;
    }

    public function setFormat(string $format): void {
        $this->format = $format;
    }

    function __toString() {
        return $this->getTitle() . '/' . $this->getFormat();
    }
}