<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Offer;
use App\Models\ProjectModel;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = ProjectModel::where('route_key', 'offers')->first();
        view()->share('model', $this->model);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Offer::orderBy('created_at', 'desc')->get();
        return view('admin.offers.index', compact('data'));
    }

    public function show(Offer $obj)
    {
        if (auth()->user()->role_id == 2) {
            if ($obj->user_id != auth()->id()) {
                return redirect()->back();
            }
        }
        return view('admin.offers.show', compact('obj'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currency = [['name' => __('front.riyal'), 'value' => '1'], ['name' =>   __('front.dirham'), 'value' => '3'], ['name' => __('front.dollar'), 'value' => '2']];
        return view('admin.offers.form', compact('currency'));
    }


    public function myOffers()
    {
        $obj = auth()->user()->offers->all();
        return view('admin.offers.index', ['data' => $obj]);
    }




    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => "required",
            'category' => "required",
            'area' => "required",
            'price' => "numeric",
            'currency' => "required",
            'city_ar' => "required",
            'city_en' => "required",
            'neighborhood_ar' => "required",
            'neighborhood_en' => "required",
            'place_ar' => "required",
            'place_en' => "required",
            'description_ar' => "nullable",
            'description_en' => "nullable",
            'images[]' => "nullable",
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->id();
        unset($input['images'], $input['is_active']);
        $offer = Offer::create($input);
        if ($request->images) {
            foreach ($request->images as $image) {
                Image::create([
                    'offer_id' => $offer->id,
                    'path' => generalUpload('Offer', $image)
                ]);
            }
        }
        $status = true;
        $msg = __('dash.created successfully');
        if (auth()->user()->role_id == 2) {
            $url = route('dashboard.my_offers.index');
        } else {
            $url = route('dashboard.' . $this->model->route_key . '.index');
        }
        return response()->json(compact('status', 'msg', 'url'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Offer $obj)
    {
        $array =  [['value' => "0", 'name' => __('dash.disabled')], ['value' => "1", 'name' => __('dash.active')]];
        return view('admin.offers.form', ['data' => $obj, 'array' => $array]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $obj)
    {
        $this->validate($request, [
            'is_active' => 'required|in:0,1',
        ]);

        $obj->update(
            [
                'is_active' => $request->is_active,
            ]
        );

        $status = true;
        $msg = __('dash.updated successfully');
        $url = route('dashboard.' . $this->model->route_key . '.index');

        return response()->json(compact('status', 'msg', 'url'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Offer $obj)
    {
        try {
            if (auth()->user()->role_id == 2) {
                if ($obj->user_id != auth()->id()) {
                    return response()->json(['status' => false, 'msg' => __('dash.not_allowed')]);
                }
            }
            $obj->delete();
            $status = true;
            $msg = __('dash.deleted_successfully');
        } catch (\Exception $e) {
            $status = false;
            $msg = $e->getMessage();
        }
        return response()->json(compact('status', 'msg'));
    }
}
