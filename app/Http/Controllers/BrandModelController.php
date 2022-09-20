<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class BrandModelController extends Controller
{
    public function index(): Response
    {
        $brandmodels = BrandModel::all();
        $brands = Brand::all();

        return Inertia::render('BrandModel/Index', compact('brands','brandmodels'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'name' => 'required',
            'brand_id' => 'required'
        ]);

        BrandModel::query()->create($validated);

        return Redirect::route("brandmodel.index");
    }

    public function destroy(BrandModel $brandmodel): RedirectResponse
    {
        $brandmodel->delete();

        return Redirect::route("brandmodel.index");
    }
}
