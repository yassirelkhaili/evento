<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index() {
        $adverts = Advert::with('partner:id,name')->orderBy('created_at', 'desc')->paginate(10);
        $adverts->transform(function ($advert) {
            $advert->partnerName = $advert->partner->name;
            unset($advert->partner);
            return $advert;
        });
        return view('welcome', compact('adverts'));
    }

    public function showAdvert(int $advertID) {
        try {
            $advert = Advert::with('partner')->findOrFail($advertID);
            $advertArray = $advert->toArray();
            $advertArray['partner'] = $advert->partner->toArray();
    
            return view("profile.show", ["advert" => $advertArray]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Advert not found. errorcode: ' . $e->getMessage()], 404);
        }
}
}