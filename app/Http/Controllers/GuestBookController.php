<?php

namespace App\Http\Controllers;

use App\Services\JsonGuestService;
use Illuminate\Http\Request;

class GuestBookController extends Controller
{
    protected $guestService;

    public function __construct(JsonGuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    public function list(Request $request)
    {
        $perPage = $request->get('per_page', 3);
        $page = $request->get('page', 1);

        $pagination = $this->guestService->paginate($perPage, $page);

        return response()->json([
            'data' => $pagination->items(),
            'current_page' => $pagination->currentPage(),
            'last_page' => $pagination->lastPage(),
            'per_page' => $pagination->perPage(),
            'total' => $pagination->total(),
            'has_more' => $pagination->hasMorePages()
        ]);
    }

    public function store(Request $request)
    {
        $newGuest = $this->guestService->store($request->only(['name', 'presence', 'person', 'comment']));

        return $newGuest;
    }
}
