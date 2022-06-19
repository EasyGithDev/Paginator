<?php

abstract class AbstractPresenter implements Presenter
{
    protected $paginator;

    function __call($name, $arguments)
    {
        switch ($name) {
            case 'firstPage':
                return $this->paginator->firstPage();
                break;
            case 'previousPage':
                return $this->paginator->previousPage();
                break;
            case 'nextPage':
                return $this->paginator->nextPage();
                break;
            case 'lastPage':
                return $this->paginator->lastPage();
                break;
            case 'requestParameter':
                return $this->paginator->getRequestParameter();
                break;
        }
    }

    abstract function first(): string;

    abstract function previous(): string;

    abstract function listEnabled(int $i): string;

    abstract function listDisabled(int $i): string;

    abstract function next(): string;

    abstract function last(): string;

    abstract function embed(string $str): string;
}
