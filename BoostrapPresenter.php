<?php

class BoostrapPresenter implements Presenter
{
    protected $nav;
    function __construct($nav)
    {
        $this->nav = $nav;
    }

    function start(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?page=1">First</a>
        </li>';
    }

    function previous(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?page=' . ($this->nav->getCurrentPage() - 1) . '">Previous</a>
        </li>';
    }

    function listEnabled(int $i): string
    {

        return '<li class="page-item">
        <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
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
        <a class="page-link" href="?page=' . ($this->nav->getCurrentPage() + 1) . '">Next</a>
        </li>';
    }

    function last(): string
    {
        return '<li class="page-item">
        <a class="page-link" href="?page=' . $this->nav->getNbPage() . '">Last</a>
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
