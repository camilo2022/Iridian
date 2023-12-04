<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contacts\ContactsIndexRequest;
use App\Http\Requests\Contacts\ContactsStoreRequest;
use App\Http\Resources\Contacts\ContactsIndexCollection;
use App\Models\Contact;
use App\Traits\ApiMessage;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Database\QueryException;

class ContactController extends Controller
{
    use ApiResponser;
    use ApiMessage;

    public function index(ContactsIndexRequest $request)
    {
        try {
            $contacts = Contact::with('contact_area')->paginate($request->input('perPage'));

            return $this->successResponse(
                new ContactsIndexCollection($contacts),
                $this->getMessage('Success'),
                200
            );
        } catch (QueryException $e) {
            // Manejar la excepción de la base de datos
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('QueryException'),
                    'error' => $e->getMessage()
                ],
                500
            );
        } catch (Exception $e) {
            // Manejar cualquier otro tipo de excepcion
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('Exception'),
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }

    public function store(ContactsStoreRequest $request)
    {
        try {
            $contact = new Contact();
            $contact->name = $request->input('name');
            $contact->lastname = $request->input('lastname');
            $contact->email = $request->input('email');
            $contact->phone = $request->input('phone');
            $contact->contact_area_id = $request->input('contact_area_id');
            $contact->message = $request->input('message');
            $contact->save();

            return $this->successResponse(
                '',
                'El contacto fue registrado exitosamente.',
                201
            );
        } catch (QueryException $e) {
            // Manejar excepcion por si algun campo no existe o formato erroneo
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('QueryException'),
                    'error' => $e->getMessage()
                ],
                500
            );
        } catch (Exception $e) {
            // Manejar cualquier otro tipo de excepcion
            return $this->errorResponse(
                [
                    'message' => $this->getMessage('Exception'),
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }
}
