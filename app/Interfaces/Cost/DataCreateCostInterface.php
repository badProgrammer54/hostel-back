<?php


namespace App\Interfaces\Cost;


interface DataCreateCostInterface
{
    public function getDateStart();

    public function getDateEnd();

    public function getTitle(): string;

    public function getCost(): int;

}