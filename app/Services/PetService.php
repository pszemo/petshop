<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;

class PetService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://petstore.swagger.io/v2';
    }

    /**
     * Pobierz wszystkie zwierzęta na podstawie statusu
     */
    public function getAllPets($status = 'available')
    {
        try {
            $response = Http::get("$this->baseUrl/pet/findByStatus", [
                'status' => $status,
            ]);
            $this->handleErrors($response);
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception("Błąd przy pobieraniu zwierząt: " . $e->getMessage());
        }
    }

    /**
     * Pobierz dane pojedynczego zwierzęcia
     */
    public function getPet($petId)
    {
        try {
            $response = Http::get("$this->baseUrl/pet/$petId");
            $this->handleErrors($response);
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception("Błąd przy pobieraniu zwierzęcia: " . $e->getMessage());
        }
    }

    /**
     * Dodaj nowe zwierzę
     */
    public function addPet($data)
    {
        try {
            $response = Http::post("$this->baseUrl/pet", $data);
            $this->handleErrors($response);
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception("Błąd przy dodawaniu zwierzęcia: " . $e->getMessage());
        }
    }

    /**
     * Aktualizuj dane zwierzęcia
     */
    public function updatePet($data)
    {
        try {
            $response = Http::put("$this->baseUrl/pet", $data);
            $this->handleErrors($response);
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception("Błąd przy aktualizacji zwierzęcia: " . $e->getMessage());
        }
    }

    /**
     * Usuń zwierzę
     */
    public function deletePet($petId)
    {
        try {
            $response = Http::delete("$this->baseUrl/pet/$petId");
            $this->handleErrors($response);
            return $response->json();
        } catch (RequestException $e) {
            throw new \Exception("Błąd przy usuwaniu zwierzęcia: " . $e->getMessage());
        }
    }

    /**
     * Obsługuje błędy odpowiedzi HTTP
     */
    private function handleErrors(Response $response)
    {
        if ($response->clientError()) {
            throw new \Exception("Błąd po stronie klienta: " . $response->body());
        }

        if ($response->serverError()) {
            throw new \Exception("Błąd po stronie serwera: " . $response->body());
        }
    }
}
