<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sliders() {
        $sliders = Slider::get();
        return view('admin.sliders')->with('sliders', $sliders);
    }

    public function addslider() {
        return view('admin.addslider');
    }

    public function saveslider(Request $request) {
        // Product Validation
        $this->validate($request, [
            'description_one' => 'required',
            'description_two' => 'required',
            'slider_image' => 'image|nullable|max:1999'

        ]);
        // Slider Image Store
        if ($request->hasFile('slider_image')) {
            // get filename with ext
            $filenamewithext = $request->file('slider_image')->getClientOriginalName();

            //  get filename
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            //file name to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //upload image
            $request->file('slider_image')->storeAs('public/slider_image', $filenametostore);
        }else {
            $filenametostore = 'noimage.jpg';
        }
        // Slider Save
        $slider = new Slider();
        $slider->description1 = $request->description_one;
        $slider->description2 = $request->description_two;
        $slider->slider_image = $filenametostore;
        $slider->status = 1;

        $slider->save();

        return redirect()->route('slider.create')->with('status', 'The Slider has been Create successfully');
    }

    public function editslider($id) {

        $slider = Slider::findOrFail($id);

        return view('admin.editslider')->with('slider', $slider);
    }

    public function updateslider(Request $request, $id) {
        // Product Validation
        $this->validate($request, [
        'description_one' => 'required',
        'description_two' => 'required',
        'slider_image' => 'image|nullable|max:1999'

        ]);
        // Slider Save
        $slider = Slider::findOrFail($request->id);
        $slider->description1 = $request->description_one;
        $slider->description2 = $request->description_two;

        // IMAGE UPDATE
        if ($request->hasFile('slider_image')) {
            $filenamewithext = $request->file('slider_image')->getClientOriginalName();
            //  get filename
            $filename = pathinfo($filenamewithext, PATHINFO_FILENAME);

            //get just extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();

            //file name to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //upload image
            $path = $request->file('slider_image')->storeAs('public/slider_image', $filenametostore);

            // OLD IMAGE DELETE
            $old_image = Slider::findOrFail($request->id);
            if ($old_image->slider_image != 'noimage.jpg') {
                Storage::delete(['public/slider_image/'.$old_image->slider_image]);
            }
            $slider->slider_image = $filenametostore;
        }
        $slider->save();

        return redirect()->route('slider.index')->with('status', 'Slider has been updated successfully');
    }

    public function deleteslider($id) {
        $slider = Slider::findOrFail($id);
        if ($slider->slider_image != 'noimage.jpg') {
            Storage::delete(['public/slider_image/'.$slider->slider_image]);
        }
        $slider->delete();
        return redirect()->route('slider.index')->with('status', 'Slider has been deleted successfully');
    }

     // ACTIVITED & UNACTIVITED
    public function activated($id) {
        $slider = Slider::findOrFail($id);
        $slider->status = 1;
        $slider->update();
        return back()->with('status', 'Slider has been Activated successfully');
    }
    public function unactivated($id) {
        $slider = Slider::findOrFail($id);
        $slider->status = 0;
        $slider->update();
        return back()->with('status', 'Slider has been Unactivated successfully');
    }

}
