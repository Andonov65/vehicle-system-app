<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Intervention\Image\Facades\Image;

class VehicleController extends Controller
{
    public function index(): Response
    {
        $vehicles = Vehicle::query()->paginate();

        return Inertia::render('Vehicle/Index', compact('vehicles'));
    }

    public function create(): Response
    {
        $brand_models = BrandModel::all();
        return Inertia::render('Vehicle/Create', compact('brand_models'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'brand_model_id' => 'required',
            'chassis_number' => 'required',
            'title' => 'required',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp'
        ]);

        $vehicle = new Vehicle();
        $vehicle->brand_model_id = $request->input('brand_model_id');
        $vehicle->chassis_number = $request->input('chassis_number');
        $vehicle->title = $request->input('title');
        $vehicle->details = $request->input('details');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $filename = "vehicle-images\upload_" . $filename;
            $img = Image::make($image)->resize(300, 300)->stream();
            Storage::put($filename, $img);
            $vehicle->image = $filename;
        }

        $vehicle->save();

        return Redirect::route("vehicle.index");
    }

    public function edit(Vehicle $vehicle): Response
    {
        $brand_models = BrandModel::all();
        return Inertia::render('Vehicle/Edit', compact('vehicle', 'brand_models'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Vehicle $vehicle, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'brand_model_id' => 'required',
            'chassis_number' => 'required',
            'title' => 'required',
            'details' => 'required',
            'image' => 'nullable|exclude_if:image,null|image|mimes:jpeg,png,jpg,svg,webp'
        ]);

        if ($request->hasFile('image')) {

            Storage::delete($vehicle->getRawOriginal('image'));

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $filename = "vehicle-images\upload_" . $filename;
            $img = Image::make($image)->resize(300, 300)->stream();
            Storage::put($filename, $img);
            $validated['image'] = $filename;
        }
        $vehicle->fill($validated);
        $vehicle->save();

        return Redirect::route("vehicle.index");
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->delete();
        return Redirect::route("vehicle.index");
    }
}
