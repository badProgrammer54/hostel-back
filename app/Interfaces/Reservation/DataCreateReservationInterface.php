<?php


namespace App\Interfaces\Reservation;


interface DataCreateReservationInterface
{
    public function getDateArrival();

    public function getDateLeave();

    public function getNumberGuests(): ?int;

    public function getPhone(): ?string;

    public function getName(): ?string;

    public function getEmail(): ?string;

    public function getMessage(): ?string;

}