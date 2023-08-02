<?php

namespace App\Services;

use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\Auth;

class ContactService
{
    /**
     * @throws Exception
     */
    public function get(string $id = '')
    {
        if (!empty($id)) {
            $contact = Contact::find($id);
            if (!$contact) {
                throw new Exception("Contato não encontrado!");
            }
            if ($contact->user_id !== Auth::id()) {
                throw new Exception("Este contato não pertence ao usuario logado!");
            }
            return $contact;
        }
//        return Contact::all();
        return Contact::where('user_id', Auth::id())->get();
    }

    /**
     * @throws \Exception
     */
    public function store(array $data = [])
    {
        $contato = Contact::create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        if (!$contato) {
            return throw new \Exception('Erro ao salvar contato');
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function update(array $data = [])
    {

        $contact = Contact::find($data['id']);

        if (!$contact) {
            throw new Exception("Contato não encontrado!");
        }

        if ($contact->user_id !== Auth::id()) {
            throw new Exception("Este contato não pertence ao usuario logado!");

        }

        if (!$contact->update($data)) {
            throw new Exception("Erro ao atualizar contato!");
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            throw new Exception("Contato não encontrado!");
        }

        if ($contact->user_id !== Auth::id()) {
            throw new Exception("Este contato não pertence ao usuario logado!");

        }

        $contact->delete();

        return true;
    }
}
