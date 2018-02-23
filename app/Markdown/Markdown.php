<?php

namespace App\Markdown;


class Markdown
{
    public $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function markdown($text)
    {
        return $this->parser->makeHtml($text);
    }

}
