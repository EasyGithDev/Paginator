<?php
namespace EasyGithDev\Paginator;

class DefaultPresenter implements Presenter
{
    protected $nav;
    function __construct($nav)
    {
        $this->nav = $nav;
    }

    function first(): string
    {
        return  '<a href="?page=1">&lt;&lt;</a>&nbsp;';
    }

    function previous(): string
    {
        return '<a href="?page=' . ($this->nav->getCurrentPage() - 1) . '">&lt;</a>&nbsp;';
    }

    function listEnabled(int $i): string
    {
        return '<a href="?page=' . $i . '">' . $i . '</a>&nbsp;';
    }

    function listDisabled(int $i): string
    {
        return $i . '&nbsp;';
    }
    function next(): string
    {
        return '<a href="?page=' . ($this->nav->getCurrentPage() + 1) . '">&gt;</a>&nbsp;';
    }

    function last(): string
    {
        return '<a href="?page=' . $this->nav->getNbPage() . '">&gt;&gt;</a>';
    }

    function embed(string $str): string
    {
        return $str;
    }
}
