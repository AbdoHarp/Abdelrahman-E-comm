<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin/slider/index', compact('sliders'));
    }
    public function create()
    {
        return view('admin/slider/create');
    }
    public function store(SliderFormRequest $request)
    {
        $ValidatedData = $request->Validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/slider/', $filename);
            $ValidatedData['image'] = "uploads/slider/$filename";
        }
        $ValidatedData['status'] = $request->status == true ? '1' : '0';
        Slider::create([
            'title' => $ValidatedData['title'],
            'description' => $ValidatedData['description'],
            'image' => $ValidatedData['image'],
            'status' => $ValidatedData['status']
        ]);
        return redirect('admin/sliders')->with('message', 'Slider Added Successfully');
    }
    public function edit(int $slider_id)
    {
        $slider = Slider::findOrFail($slider_id);
        return view('admin/slider/edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, $slider)
    {
        $ValidatedData = $request->Validated();
        $slider = Slider::findOrFail($slider);
        if ($request->hasFile('image')) {
            $destintion = $slider->image;
            if (File::exists($destintion)) {
                File::delete($destintion);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/slider/', $filename);
            $ValidatedData['image'] = "uploads/slider/$filename";
        }
        $ValidatedData['status'] = $request->status == true ? '1' : '0';
        Slider::where('id', $slider->id)->update([
            'title' => $ValidatedData['title'],
            'description' => $ValidatedData['description'],
            'image' => $ValidatedData['image'] ?? $slider->image,
            'status' => $ValidatedData['status']
        ]);
        return redirect('admin/sliders')->with('message', 'Slider Updated Successfully');
    }
    public function destroy($slider)
    {

        $sliders = Slider::findOrFail($slider);
        if ($sliders->count() > 0) {
            $destintion = $sliders->image;
            if (File::exists($destintion)) {
                File::delete($destintion);
            }
            $sliders->delete();
            return redirect('admin/sliders')->with('message', 'Slider Deleted Successfully');
        }
        return redirect('admin/sliders')->with('message', 'Something Went Wrong');
    }
}
