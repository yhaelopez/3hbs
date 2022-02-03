<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRemarkRequest;
use App\Http\Requests\UpdateRemarkRequest;
use App\Http\Resources\RemarkCollection;
use App\Http\Resources\RemarkResource;
use App\Models\Remark;

class RemarkController extends Controller
{
    public function index()
    {
        return RemarkCollection::make(Remark::get());
    }

    public function store(StoreRemarkRequest $request)
    {
        $remark = Remark::create($request->validated());
        return RemarkResource::make($remark);
    }

    public function show(Remark $remark)
    {
        return RemarkResource::make($remark);
    }

    public function update(UpdateRemarkRequest $request, Remark $remark)
    {
        $remark->update($request->validated());
        return RemarkResource::make($remark);
    }

    public function destroy(Remark $remark)
    {
        $remark->delete();
        return RemarkResource::make($remark);
    }
}
