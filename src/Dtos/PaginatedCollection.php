<?php

namespace Mdigi\PBB\Dtos;

class PaginatedCollection
{
    public $data;
    public $currentPage;
    public $perPage;
    public $onFirstPage;
    public $lastPage;
    public $count;
    public $total;

    public function __construct($data, $currentPage, $perPage, $onFirstPage, $lastPage, $count, $total)
    {
        $this->data = $data;
        $this->currentPage = $currentPage;
        $this->perPage = $perPage;
        $this->onFirstPage = $onFirstPage;
        $this->lastPage = $lastPage;
        $this->count = $count;
        $this->total = $total;
    }

    public static function map($data, $pagination)
    {
        return new self($data, $pagination->currentPage(), $pagination->perPage(), $pagination->onFirstPage(), $pagination->lastPage(), $pagination->count(), $pagination->total());
    }

    public function currentPage()
    {
        return $this->currentPage;
    }

    public function perPage()
    {
        return $this->perPage;
    }

    public function onFirstPage()
    {
        return $this->onFirstPage;
    }

    public function lastPage()
    {
        return $this->lastPage;
    }

    public function count()
    {
        return $this->count;
    }

    public function total()
    {
        return $this->total;
    }
}