<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Inertia\Response;

class BrandController extends Controller
{
    public function index(): Response
    {
        $brands = Brand::all();

        return Inertia::render('Brand/Index', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'name' => 'required',
        ]);

        Brand::query()->create($validated);

        return Redirect::route("brand.index");
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();

        return Redirect::route("brand.index");
    }
}
