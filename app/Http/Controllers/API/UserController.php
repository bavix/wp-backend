<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\User\StoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User\Contact;
use App\Models\User\User;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')
            ->except(['store']);
    }

    /**
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request) {
        return User::with($request->query('relations'))->get();
    }

    /**
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws
     */
    public function store(StoreRequest $request) {
        $email = $request->input(Contact::TYPE_EMAIL);
        $user = new User();
        $user->fill($request->validated());

        DB::transaction(function () use ($email, $user) {
            $user->saveOrFail();

            $contact = new Contact();
            $contact->type = Contact::TYPE_EMAIL;
            $contact->value = $email;
            $contact->notify = 1;
            $contact->user()->associate($user);
            $contact->saveOrFail();
        });

        return response()
            ->json($user->load(User::REL_CONTACTS))
            ->setStatusCode(201);
    }

}
