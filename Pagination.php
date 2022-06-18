<?php

require 'DefaultPresenter.php';
require 'BoostrapPresenter.php';

class Pagination
{

    /**
     * Constant for display
     */
    const DISPLAY_FIRST = 1;
    const DISPLAY_PREV = 2;
    const DISPLAY_LIST = 4;
    const DISPLAY_NEXT = 8;
    const DISPLAY_LAST = 16;

    const DISPLAY_FIRST_LAST = self::DISPLAY_FIRST | self::DISPLAY_LAST;
    const DISPLAY_PREV_NEXT = self::DISPLAY_PREV | self::DISPLAY_NEXT;
    const DISPLAY_ALL = self::DISPLAY_FIRST_LAST | self::DISPLAY_PREV_NEXT | self::DISPLAY_LIST;

    /**
     * Presenter
     */
    protected $presenterClass;
    protected $presenter;

    /** Total results */
    protected $nbResults;

    /** Result per page */
    protected $resultsPerPage;

    /** Current page */
    protected $currentPage;

    /** Numbre of pages */
    protected $nbPage;

    /** Display type */
    protected $display;

    function __construct(int $nbResults, int $resultsPerPage = 10)
    {
        $this->nbResults = $nbResults;
        $this->resultsPerPage = $resultsPerPage;
        $this->presenterClass = DefaultPresenter::class;
        $this->display = self::DISPLAY_ALL;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getNbPage(): int
    {
        return $this->nbPage;
    }

    public function setPresenterClass(string $presenterClass): Pagination
    {
        $this->presenterClass = $presenterClass;
        return $this;
    }

    public function setDisplay(int $display)
    {
        $this->display = $display;
        return $this;
    }

    public function applyPresenter(): Pagination
    {
        $this->presenter = new $this->presenterClass($this);
        return $this;
    }

    protected function checkDisplay($component): bool
    {

        // printf('  val=' .  '%0' . (PHP_INT_SIZE * 8) . "b<br>", 
        // $component);


        // printf('  val=' .  '%0' . (PHP_INT_SIZE * 8) . "b<br>", 
        // $this->display);

        // printf('  val=' .  '%0' . (PHP_INT_SIZE * 8) . "b<br>", 
        // $component & $this->display);


        if (($component & $this->display) == $component) {
            return true;
        }
        return false;
    }

    protected function computeCurrentPage()
    {
        $currentPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $this->currentPage = ($currentPage) ? $currentPage : 1;
    }

    protected function computeNbPage()
    {
        $this->nbPage = $this->nbResults / $this->resultsPerPage;
    }

    function __toString(): string
    {
        if (!$this->presenter) {
            $this->applyPresenter();
        }

        $this->computeCurrentPage();
        $this->computeNbPage();

        $strNav = '';

        if ($this->currentPage > 1) {
            // start
            if ($this->checkDisplay(self::DISPLAY_FIRST)) {
                $strNav .= $this->presenter->start();
            }

            // previous
            if ($this->checkDisplay(self::DISPLAY_PREV)) {
                $strNav .= $this->presenter->previous();
            }
        }

        // list
        if ($this->checkDisplay(self::DISPLAY_LIST)) {
            for ($i = 1; $i <= $this->nbPage; $i++) {
                if ($i == $this->currentPage) {
                    $strNav .= $this->presenter->listDisabled($i);
                } else {
                    $strNav .= $this->presenter->listEnabled($i);
                }
            }
        }
        if ($this->currentPage < $this->nbPage) {
            // 
            if ($this->checkDisplay(self::DISPLAY_NEXT)) {
                $strNav .= $this->presenter->next();
            }
            // last
            if ($this->checkDisplay(self::DISPLAY_LAST)) {
                $strNav .= $this->presenter->last();
            }
        }

        return $this->presenter->embed($strNav);
    }
}
