<?php

namespace App\Requests;

use App\Entity\Dossier;

class DossierRequest 
{
    public $id;

    public $number;

    public $type;
    
    public $name;

    public $surname;

    public $address;

    public $card_number;

    public $card_cvv;

    public static function fromDossier(Dossier $dossier): self
    {
        $dossierRequest = new self();
        $dossierRequest->id = $dossier->getId();
        $dossierRequest->number = $dossier->getNumber();
        $dossierRequest->type = $dossier->getType();
        $dossierRequest->name = $dossier->getName();
        $dossierRequest->surname = $dossier->getSurname();

        $dossierAddress = $dossier->getDossierAddresses()->last();
        $dossierCard = $dossier->getDossierCards()->last();

        if ($dossierAddress) {
            $dossierRequest->address = $dossierAddress->getAddress();
        }

        if ($dossierCard) {
            $dossierRequest->card_number = $dossierCard->getNumber();
            $dossierRequest->card_cvv = $dossierCard->getCvv();
        }

        return $dossierRequest;
    }

}