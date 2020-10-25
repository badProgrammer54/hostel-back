<?php


namespace App\Interfaces;


interface DataCreateNewsPostInterface
{
    public function getIsPublished(): bool;

    public function getContentHtml(): string;

    public function getContentRaw(): string;

    public function getExcerpt(): string;

    public function getSlug(): string;

    public function getTitle(): string;

    public function getCategoryId(): int;

    public function getUserId(): int;
}