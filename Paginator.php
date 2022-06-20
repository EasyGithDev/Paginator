<?php

namespace EasyGithDev\Paginator;

class Paginator
{

    /**
     * Constant for display type
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
     * Default request parameter
     */
    const REQUEST_PARAMETER = 'page';

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
    protected $displayType;

    /** Request parameters */
    protected $requestFunction;
    protected $requestParameter;

    /** Number of pages to display */
    protected $maxPageToDisplay;

    function __construct(int $nbResults, int $resultsPerPage = 10)
    {
        $this->nbResults = $nbResults;
        $this->resultsPerPage = $resultsPerPage;
        $this->presenterClass = DefaultPresenter::class;
        $this->displayType = self::DISPLAY_ALL;
        $this->requestParameter = self::REQUEST_PARAMETER;
    }

    //////////////////////////////////////////////////////
    // Getter / Setter section
    //////////////////////////////////////////////////////

    function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    function getNbPage(): int
    {
        return $this->nbPage;
    }

    function getRequestParameter(): string
    {
        return $this->requestParameter;
    }


    function firstPage(): int
    {
        return 1;
    }

    function previousPage(): int
    {
        return ($this->getCurrentPage() - 1);
    }

    function nextPage(): int
    {
        return ($this->getCurrentPage() + 1);
    }

    function lastPage(): int
    {
        return  $this->getNbPage();
    }

    function setMaxPageToDisplay(int $maxPageToDisplay): Paginator
    {
        $this->maxPageToDisplay = $maxPageToDisplay;
        return $this;
    }

    function setRequestParameter(string $requestParameter): Paginator
    {
        $this->requestParameter = $requestParameter;
        return $this;
    }

    function setRequestFunction(string $requestFunction): Paginator
    {
        $this->requestFunction = $requestFunction;
        return $this;
    }

    function setPresenterClass(string $presenterClass): Paginator
    {
        $this->presenterClass = $presenterClass;
        return $this;
    }

    function setDisplayType(int $displayType): Paginator
    {
        $this->displayType = $displayType;
        return $this;
    }

    //////////////////////////////////////////////////////
    // Presenter section
    //////////////////////////////////////////////////////

    function applyPresenter(): Paginator
    {
        $this->presenter = new $this->presenterClass($this);
        return $this;
    }

    protected function checkDisplay($component): bool
    {

        // printf('  val=' .  '%0' . (PHP_INT_SIZE * 8) . "b<br>", 
        // $component);


        // printf('  val=' .  '%0' . (PHP_INT_SIZE * 8) . "b<br>", 
        // $this->displayType);

        // printf('  val=' .  '%0' . (PHP_INT_SIZE * 8) . "b<br>", 
        // $component & $this->displayType);


        if (($component & $this->displayType) == $component) {
            return true;
        }
        return false;
    }

    //////////////////////////////////////////////////////
    // Compute section
    //////////////////////////////////////////////////////

    protected function computeRequestPage(): mixed
    {
        return filter_input(INPUT_GET, $this->requestParameter, FILTER_VALIDATE_INT);
    }

    protected function computeCurrentPage(): void
    {
        if (!is_null($this->requestFunction)) {
            $currentPage = call_user_func($this->requestFunction);
        } else {
            $currentPage = $this->computeRequestPage();
        }

        $this->currentPage = ($currentPage) ? $currentPage : 1;
    }

    protected function computeNbPage(): void
    {
        $this->nbPage = $this->nbResults / $this->resultsPerPage;
    }

    //////////////////////////////////////////////////////
    // Display section
    //////////////////////////////////////////////////////

    function displayFirst(): string
    {
        return  $this->presenter->first();
    }

    function displayPrevious(): string
    {
        return $this->presenter->previous();
    }

    function displayList(): string
    {
        $strNav = '';
        $start = 1;
        $end = $this->nbPage;
        if (!is_null($this->maxPageToDisplay)) {
            $start = ($this->currentPage > $this->maxPageToDisplay) ? ($this->currentPage - $this->maxPageToDisplay + 1) : 1;
            $end = ($this->maxPageToDisplay < $this->nbPage) ? ($start + $this->maxPageToDisplay - 1) : $this->nbPage;
        }

        for ($i = $start; $i <= $end; $i++) {
            if ($i == $this->currentPage) {
                $strNav .= $this->presenter->listDisabled($i);
            } else {
                $strNav .= $this->presenter->listEnabled($i);
            }
        }
        return $strNav;
    }

    function displayNext(): string
    {
        return $this->presenter->next();
    }

    function displayLast(): string
    {
        return $this->presenter->last();
    }

    function __toString(): string
    {
        if (!$this->presenter) {
            $this->applyPresenter();
        }

        $this->computeCurrentPage();
        $this->computeNbPage();

        $strNav = '';

        // start
        if ($this->checkDisplay(self::DISPLAY_FIRST)) {
            $strNav .= $this->displayFirst();
        }

        // previous
        if ($this->checkDisplay(self::DISPLAY_PREV)) {
            $strNav .= $this->displayPrevious();
        }

        // list
        if ($this->checkDisplay(self::DISPLAY_LIST)) {
            $strNav .= $this->displayList();
        }

        // next
        if ($this->checkDisplay(self::DISPLAY_NEXT)) {
            $strNav .= $this->displayNext();
        }
        // last
        if ($this->checkDisplay(self::DISPLAY_LAST)) {
            $strNav .= $this->displayLast();
        }

        return $this->presenter->embed($strNav);
    }
}
