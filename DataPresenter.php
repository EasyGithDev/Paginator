<?php

class DataPresenter extends AbstractPresenter
{
    function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    function first(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?' . $this->requestParameter() . '=' . $this->firstPage() . '" aria-label="First">
        <span aria-hidden="true">&laquo;&laquo;</span>
        </a>
        </li>';
    }

    function previous(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?' . $this->requestParameter() . '=' . $this->previousPage() . '" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        </a>
        </li>';
    }

    function listEnabled(int $i): string
    {

        return '<li class="page-item">
        <a class="page-link" href="?' . $this->requestParameter() . '=' . $i . '">' . $i . '</a>
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
        <a class="page-link" href="?' . $this->requestParameter() . '=' . $this->nextPage() . '" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        </a>
        </li>';
    }

    function last(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?' . $this->requestParameter() . '=' . $this->lastPage() . '" aria-label="Last">
        <span aria-hidden="true">&raquo;&raquo;</span>
        </a>
        </li>';
    }

    function embed(string $str): string
    {
        return '<nav aria-label="Page navigation example">
            <ul class="pagination pagination">' .
            $str .
            '</ul>
            </nav>';
    }
}
