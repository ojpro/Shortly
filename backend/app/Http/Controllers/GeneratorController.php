<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneratorRequest;
use AshAllenDesign\ShortURL\Facades\ShortURL;
use Illuminate\Http\Request;

class GeneratorController extends Controller
{
    /*
     * generate method
     */

    public function generate(GeneratorRequest $request)
    {
        $request->validated();

        $shortUrlObject = ShortURL::destinationUrl($request->query('destination'))->make();

        return response(['short_link' => $shortUrlObject->default_short_url]);
    }
}
