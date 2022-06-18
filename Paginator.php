<?php

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

    protected $requestFunction;
    protected $requestParameter;

    function __construct(int $nbResults, int $resultsPerPage = 10)
    {
        $this->nbResults = $nbResults;
        $this->resultsPerPage = $resultsPerPage;
        $this->presenterClass = DefaultPresenter::class;
        $this->displayType = self::DISPLAY_ALL;
        $this->requestParameter = 'page';
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getNbPage(): int
    {
        return $this->nbPage;
    }

    public function getRequestParameter(): string
    {
        return $this->requestParameter;
    }


    public function firstPage(): int
    {
        return 1;
    }

    public function previousPage(): int
    {
        return ($this->getCurrentPage() - 1);
    }

    public function nextPage(): int
    {
        return ($this->getCurrentPage() + 1);
    }

    public function lastPage(): int
    {
        return  $this->getNbPage();
    }

    public function setRequestParameter(string $requestParameter): Paginator
    {
        $this->requestParameter = $requestParameter;
        return $this;
    }

    public function setRequestFunction(string $requestFunction): Paginator
    {
        $this->requestFunction = $requestFunction;
        return $this;
    }

    public function setPresenterClass(string $presenterClass): Paginator
    {
        $this->presenterClass = $presenterClass;
        return $this;
    }

    public function setDisplay(int $display)
    {
        $this->displayType = $display;
        return $this;
    }

    public function applyPresenter(): Paginator
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

    protected function defaultRequestFunction()
    {
        return filter_input(INPUT_GET, $this->requestParameter, FILTER_VALIDATE_INT);
    }

    protected function computeCurrentPage()
    {

        if (!is_null($this->requestFunction)) {
            $currentPage = call_user_func($this->requestFunction);
        } else {
            $currentPage = $this->defaultRequestFunction();
        }

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

        // User is on the first page
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

        // User is on the last page
        if ($this->currentPage < $this->nbPage) {
            // next
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
