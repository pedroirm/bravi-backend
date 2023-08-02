<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Services\ContactService;
use Exception;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $service,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        return response()
            ->json(
                $this->service->get()
                , 200);
    }

    public function store(StoreContactRequest $request): JsonResponse
    {
        try {
            $this->service->store($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'Cadastrado com sucesso!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faield',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateContactRequest $request, $id): JsonResponse
    {
        try {
            $this->service->update($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => 'Atualizado com sucesso!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faield',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * @throws Exception
     */
    public function show($id): JsonResponse
    {

        return response()
            ->json($this->service->get($id), 200);
    }

    public function destroy($id)
    {
        try {
            $this->service->destroy($id);
            return response()
                ->json([
                    'status' => 'Success',
                    'message' => 'Deletado com Sucesso!'
                ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faield',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
