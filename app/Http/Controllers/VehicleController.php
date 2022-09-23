<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $vehicles = Vehicle::query()->with('brandModel', 'brandModel.brand')->get();

        return Inertia::render('Vehicle/Index', compact('vehicles'));
    }

    public function create(): Response
    {
        $brand_models = Brand::query()->with('brandModels')->get();

        return Inertia::render('Vehicle/Create', compact('brand_models'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validate($request, [
            'brand_model_id' => 'required',
            'chassis_number' => 'required',
            'title' => 'required',
            'details' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,webp'
        ]);

        unset($validated['image']);

        $vehicle = new Vehicle($validated);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $filename = "vehicle-images\upload_" . $filename;
            $img = Image::make($image)->resize(300, 300)->stream();
            Storage::put($filename, $img);
            $vehicle->image = $filename;
        }

        BrandModel::query()->find($validated['brand_model_id'])->vehicles()->create([
            'chassis_number' => $vehicle->chassis_number,
            'title' => $vehicle->title,
            'details' => $vehicle->details,
            'image' => $vehicle->image
        ]);

        return Redirect::route("vehicles.index");
    }

    public function edit(Vehicle $vehicle): Response
    {
        $brand_finding = BrandModel::query()->where('id', '=', $vehicle->brand_model_id)->get();
        $brand_models = Brand::query()->find($brand_finding[0]->brand_id)->brandmodels;
        $brand = Brand::query()->find($brand_models[0]->brand_id);

//        $vehicle = Vehicle::query()->find($vehicle)->last()->loadMissing('brand_model', 'brand_model.brand');

        return Inertia::render('Vehicle/Edit', compact('vehicle', 'brand_models', 'brand'));
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
        $brandModel = $validated['brand_model_id'];
        unset($validated['brand_model_id']);

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
        $vehicle->brandModel()->associate($brandModel);

        $vehicle->save();

        return Redirect::route("vehicles.index");
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->delete();
        return Redirect::route("vehicles.index");
    }
}
