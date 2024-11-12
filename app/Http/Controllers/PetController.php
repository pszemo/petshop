<?php

namespace App\Http\Controllers;

use App\Services\PetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        try {
            $pets = $this->petService->getAllPets();
            return view('pets.index', compact('pets'));
        } catch (Exception $e) {
            Log::error("Błąd pobierania zwierząt: " . $e->getMessage());
            return back()->withErrors(['error' => 'Nie udało się pobrać listy zwierząt.']);
        }
    }

    public function create()
    {
        return view('pets.create');
    }

    public function edit($id)
    {
        try {
            $pet = $this->petService->getPet($id);
            return view('pets.edit', compact('pet'));
        } catch (Exception $e) {
            Log::error("Błąd pobierania zwierzęcia: " . $e->getMessage());
            return back()->withErrors(['error' => 'Nie udało się pobrać danych zwierzęcia.']);
        }
    }

    public function show($id)
    {
        try {
            $pet = $this->petService->getPet($id);
            return response()->json($pet);
        } catch (Exception $e) {
            Log::error("Błąd pobierania zwierzęcia: " . $e->getMessage());
            return response()->json(['error' => 'Nie udało się pobrać danych zwierzęcia.'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:available,pending,sold',
        ]);

        try {
            $pet = $this->petService->addPet($request->all());
            return response()->json($pet);
        } catch (Exception $e) {
            Log::error("Błąd dodawania zwierzęcia: " . $e->getMessage());
            return response()->json(['error' => 'Nie udało się dodać zwierzęcia.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string|in:available,pending,sold',
        ]);

        $data = $request->all();
        $data['id'] = $id;

        try {
            $pet = $this->petService->updatePet($data);
            return response()->json($pet);
        } catch (Exception $e) {
            Log::error("Błąd aktualizacji zwierzęcia: " . $e->getMessage());
            return response()->json(['error' => 'Nie udało się zaktualizować zwierzęcia.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pet = $this->petService->deletePet($id);
            return response()->json($pet);
        } catch (Exception $e) {
            Log::error("Błąd usuwania zwierzęcia: " . $e->getMessage());
            return response()->json(['error' => 'Nie udało się usunąć zwierzęcia.'], 500);
        }
    }
}
