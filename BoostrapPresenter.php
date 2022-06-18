<?php

class BoostrapPresenter extends AbstractPresenter
{
    function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    function start(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?'.$this->requestParameter().'=' . $this->firstPage() . '">First</a>
        </li>';
    }

    function previous(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?'.$this->requestParameter().'=' . $this->previousPage() . '">Previous</a>
        </li>';
    }

    function listEnabled(int $i): string
    {

        return '<li class="page-item">
        <a class="page-link" href="?'.$this->requestParameter().'=' . $i . '">' . $i . '</a>
        </li>';
    }

    function listDisabled(int $i): string
    {
        return '<li class="page-item active" aria-current="page">
        <span class="page-link" href="#">' . $i . '</span>
        </li>';
    }

    function next(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?'.$this->requestParameter().'=' . $this->nextPage() . '">Next</a>
        </li>';
    }

    function last(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?'.$this->requestParameter().'=' . $this->lastPage() . '">Last</a>
        </li>';
    }

    function embed(string $str): string
    {
        return '<nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg">' .
            $str .
            '</ul>
            </nav>';
    }
}
