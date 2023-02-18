<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;
use Illuminate\Auth\Events\Validated;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin/colors/index', compact('colors'));
    }
    public function create()
    {
        return view('admin/colors/create');
    }
    public function store(ColorFormRequest $request)
    {
        $ValidatedData = $request->Validated();
        $ValidatedData['status'] = $request->status == true ? '1' : '0';
        Color::create($ValidatedData);
        return redirect('admin/colors')->with('message', 'Colors Added Successfully');
    }
    public function edit(int $color_id)
    {
        $colors = Color::findOrFail($color_id);
        return view('admin/colors/edit', compact('colors'));
    }
    public function update(ColorFormRequest $request, $color_id)
    {
        $ValidatedData = $request->validated();
        $ValidatedData['status'] = $request->status == true ? '1' : '0';
        Color::find($color_id)->update($ValidatedData);
        return redirect('admin/colors')->with('message', 'Colors Updated Successfully');
    }

    public function destroy($color_id)
    {
        $colors = Color::findOrFail($color_id);
        $colors->delete();
        return redirect('admin/colors')->with('message', 'Color Deleted Successfully');
    }
}
