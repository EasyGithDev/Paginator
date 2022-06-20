<?php

namespace EasyGithDev\Paginator;

class BootstrapPresenter extends AbstractPresenter
{
    function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    function first(): string
    {
        // User is on the first page
        $class = ($this->currentPage() <= 1) ? 'disabled' : '';

        return '<li class="page-item">
        <a class="page-link ' . $class . '" href="?' . $this->requestParameter() . '=' . $this->firstPage() . '" aria-label="First">
        <span aria-hidden="true">&laquo;&laquo;</span>
        </a>
        </li>';
    }

    function previous(): string
    {
        // User is on the first page
        $class = ($this->currentPage() <= 1) ? 'disabled' : '';

        return '<li class="page-item">
        <a class="page-link ' . $class . '" href="?' . $this->requestParameter() . '=' . $this->previousPage() . '" aria-label="Previous">
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
        // User is on the last page
        $class = ($this->currentPage() >= $this->nbPage()) ? 'disabled' : '';

        return '<li class="page-item">
        <a class="page-link ' . $class . '" href="?' . $this->requestParameter() . '=' . $this->nextPage() . '" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        </a>
        </li>';
    }

    function last(): string
    {
        // User is on the last page
        $class = ($this->currentPage() >= $this->nbPage()) ? 'disabled' : '';

        return '<li class="page-item">
        <a class="page-link ' . $class . '" href="?' . $this->requestParameter() . '=' . $this->lastPage() . '" aria-label="Last">
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
