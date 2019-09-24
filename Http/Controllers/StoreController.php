<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Store\Entities\Store;

class StoreController extends Controller
{

    /**
     * @var Store
     */
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->store->all();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('store::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Store::create($request->all());
        return ['error' => 0];
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Store $store)
    {
        return $store;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Store $store)
    {
        return $store;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Store $store)
    {
        $store->update($request->all());
        return $store;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Store $store)
    {
        $store->delete();
        return ['error' => 0];
    }

    public function storePage()
    {
        return view('store::store');
    }
}
