<?php


namespace App\Interfaces;


interface DataUpdateNewsPostInterface
{
    public function getIsPublished(): ?bool;

    public function getCategoryId(): ?int;

    public function getDataToUpdate(): array;
}