<?php

interface Presenter
{
    function start(): string;
    function previous(): string;
    function listEnabled(int $index): string;
    function listDisabled(int $index): string;
    function next(): string;
    function last(): string;
    function embed(string $str): string;
}
