<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Review;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use App\Models\specifications;

class ProductController extends Controller {
    public function index(Request $request) {
        $pageTitle    = 'All Products';
        $emptyMessage = 'No product found';
        $products     = Product::query();

        if ($request->search) {
            $products->where('name', 'LIKE', "%$request->search%")
                ->orWhere('price', 'LIKE', "%$request->search%")
                ->orWhere('product_sku', 'LIKE', "%$request->search%");
        }

        $products = $products->latest()->paginate(getPaginate());
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products'));
    }

    public function create() {
        $pageTitle   = 'Create New Product';
        $allCategory = Category::where('status', 1)->with(['subcategories' => function ($q) {
            $q->where('status', 1);
        },
        ])->orderBy('name')->get();
        $brands = Brand::where('status', 1)->orderBy('name')->get();
        return view('admin.product.create', compact('pageTitle', 'allCategory', 'brands'));
    }

    public function store(Request $request)
    {
                $request->validate([
            'name'           => 'required|max:255',
            'category_id'    => 'required',
            'brand'          => 'required',
            'description'    => 'required',
            'included'       => 'nullable',
            'odometer'       => 'nullable',
            'fuel_type'      => 'nullable',
            'transmission'   => 'nullable',
            'year'           => 'nullable',
            'body'           => 'nullable',
            'engine_size'    => 'nullable',
            'doors'          => 'nullable',
            'price'          => 'nullable',
            'image'          => ['required', 'image', new FileTypeValidate(['jpeg', 'jpg'])],
            'video_link'     => 'nullable|string|max:255',
        ]);
    
        $filename = '';
        $path     = imagePath()['product']['thumb']['path'];
        $size     = imagePath()['product']['thumb']['size'];
    
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
    


    
        $product = new Product();
        $product->name             = $request->name;
        $product->category_id      = $request->category_id;
        $product->brand_id         = $request->brand;
        $product->description      = $request->description;
        $product->included         = $request->included;
        $product->odometer         = $request->odometer;
        $product->fuel_type        = $request->fuel_type;
        $product->transmission     = $request->transmission;
        $product->year             = $request->year;
        $product->body             = $request->body;
        $product->engine_size      = $request->engine_size;
        $product->doors            = $request->doors;
        $product->price            = $request->price;
        $product->image            = $filename;
        $product->video_link       = $request->video_link;
        $product->save();
    
        $notify[] = ['success', 'Product added successfully.'];
        return redirect()->back()->withNotify($notify);
    }
    








    public function edit($id) {
        $pageTitle   = 'Update Product';
        $product = Product::find($id);
        $productgallery    = ProductGallery::where('product_id', $id)->get()->toArray();
        $specification     = specifications::where('product_id', $id)->first();
        // dd($productgallery,$specification);
        // dd($productgallery);
        $allCategory = Category::where('status', 1)->with(['subcategories' => function ($q) {
            $q->where('status', 1);
        },
        ])->orderBy('name')->get();
        $brands = Brand::where('status', 1)->orderBy('name')->get();
        return view('admin.product.edit', compact('pageTitle', 'product' ,  'productgallery', 'allCategory', 'brands','specification',));
    }

    public function update(Request $request, $id) {
        $product = Product::where('id', $id)->with('ProductGallery')->first();
        $request->validate([
            'name'           => 'required',
            'product_sku'    => 'nullable|unique:products,product_sku,' . $product->id,
            'category_id'    => 'required',
            // 'subcategory_id' => 'required',
            'brand'          => 'required',
            'price'          => 'required|numeric|gt:0',
            'quantity'       => 'required|integer|gt:0',
            'discount'       => 'nullable|numeric|min:0|max:100',
            'digital_item'   => 'required',
            'file_type'      => 'required_if:digital_item,1',
            'image'          => ['image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'files'          => 'nullable|array',
            'files.*'        => ['image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'digi_file'      => ['nullable', new FileTypeValidate(['pdf', 'docx', 'txt', 'zip', 'xlx', 'csv', 'ai', 'psd', 'pptx'])],
            'digi_link'      => 'required_if:file_type,2',
        ]);

        $filename = $product->image;

        $path = imagePath()['product']['thumb']['path'];
        $size = imagePath()['product']['thumb']['size'];

        $galleryPath = imagePath()['product']['gallery']['path'];
        $gallerySize = imagePath()['product']['gallery']['size'];

        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size,$filename);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify)->withInput();
            }

        }

        $oldImages   = $product->ProductGallery->pluck('id')->toArray();
        $imageRemove = array_values(array_diff($oldImages, $request->imageId ?? []));

        foreach ($imageRemove as $remove) {
            $singleImage = ProductGallery::find($remove);
            $location    = $galleryPath;
            removeFile($location . '/' . $singleImage->image);
            $singleImage->delete();
        }

        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $key => $image) {

                if (isset($request->imageId[$key])) {
                    $singleImage = ProductGallery::find($request->imageId[$key]);
                    $location    = $galleryPath;
                    removeFile($location . '/' . $singleImage->image);
                    $singleImage->delete();
                    $newImage           = uploadImage($image, $galleryPath, $gallerySize);
                    $singleImage->image = $newImage;
                    $singleImage->save();
                } else {
                    try {
                        $newImage = uploadImage($image, $galleryPath, $gallerySize);
                    } catch (\Exception $exp) {
                        $notify[] = ['error', 'Image could not be uploaded.'];
                        return back()->withNotify($notify);
                    }

                    $productImage             = new ProductGallery();
                    $productImage->product_id = $product->id;
                    $productImage->image      = $newImage;
                    $productImage->save();
                }

            }

        }

        $input_feature = [];

        if ($request->has('feature_title')) {

            for ($a = 0; $a < count($request->feature_title); $a++) {
                $arr                  = [];
                $arr['feature_title'] = $request->feature_title[$a];
                $arr['feature_desc']  = $request->feature_desc[$a];
                $input_feature[]      = $arr;
            }

        }

        $digiFile = $product->digi_file;

        if ($request->hasFile('digi_file')) {
            $path = imagePath()['digital_item']['path'];
            try {
                $digiFile = uploadFile($request->digi_file, $path);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload your file'];
                return back()->withNotify($notify)->withInput();
            }

        }

        $product->name             = $request->name;
        $product->category_id      = $request->category_id;
        // $product->subcategory_id   = $request->subcategory_id;
        $product->brand_id         = $request->brand;
        $product->price            = $request->price;
        $product->discount         = $request->discount;
        $product->discount_type    = $request->discount_type;
        $product->quantity         = $request->quantity;
        $product->hot_deals        = $request->hot_deals ? 1 : 0;
        $product->featured_product = $request->featured_product ? 1 : 0;
        $product->today_deals      = $request->today_deals ? 1 : 0;
        $product->status           = $request->status ? 1 : 0;
        $product->summary          = $request->summary;
        $product->description      = $request->description;
        $product->features         = json_encode($input_feature);
        $product->digital_item     = $request->digital_item;
        $product->file_type        = $request->file_type;
        $product->digi_file        = $digiFile;
        $product->digi_link        = $request->digi_link;
        $product->image            = $filename;
        $product->save();

        $notify[] = ['success', 'Product updated successfully'];
        return redirect()->back()->withNotify($notify)->withInput();
    }

    public function digitalFileDownload($id) {
        $product   = Product::findOrFail($id);
        $file      = $product->digi_file;
        $path      = imagePath()['digital_item']['path'];
        $full_path = $path . '/' . $file;
        return response()->download($full_path);
    }

    public function todayDeals(Request $request) {
        $pageTitle    = 'Today Deals Products';
        $emptyMessage = 'No product found';
        $products     = Product::where('today_deals', 1);

        if ($request->search) {
            $products->where('name', 'LIKE', "%$request->search%")
                ->orWhere('price', 'LIKE', "%$request->search%")
                ->orWhere('product_sku', 'LIKE', "%$request->search%");
        }

        $products = $products->latest()->paginate(getPaginate());
        return view('admin.product.index', compact('pageTitle', 'emptyMessage', 'products'));
    }

    public function todayDealsDiscount(Request $request) {
        $request->validate([
            'discount'      => 'required|numeric|min:0|max:100',
            'discount_type' => 'required|integer|in:1,2',
        ]);

        $general                = GeneralSetting::first();
        $general->discount      = $request->discount;
        $general->discount_type = $request->discount_type;
        $general->save();

        $notify[] = ['success', 'Today deal discount updated successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function gallery($id) {
        $pageTitle  = 'Add Gallery';
        $product  = Product::find($id);
        return view('admin.product.gallery',compact('product','pageTitle'));
    }


    public function addgallery(Request $request)
    {

        // dd($request->all());
        # code..
            $request->validate([
                'productid' => 'required|exists:products,id',
                'files.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'co2_emissions' => 'required|string',
                'urban_nonurban' => 'required|string',
                'euro_status' => 'required|string',
                'insurance_group' => 'required|string',
                'security' => 'required|string',
                'speed' => 'required|string',
                'top_speed' => 'required|string',
                'max_power' => 'required|string',
                'max_torque' => 'required|string',
                'valve_gear' => 'required|string',
                'cyl_arr' => 'required|string',
                'gears' => 'required|string',
                'aspiration' => 'required|string',
                'cylinders' => 'required|string',
                'drive_rear' => 'required|string',
                'length' => 'required|string',
                'breath' => 'required|string',
                'height' => 'required|string',
                'max_gross_weight' => 'required|string',
                'towing_weight_braked' => 'required|string',
                'towing_weight_unbraked' => 'required|string',
                'seats' => 'required|string',
                'adult' => 'required|string',
                'child' => 'required|string',
                'pedestrian' => 'required|string',
                'safety_assist' => 'required|string',
                'overall' => 'required|string',
            ]);
        
            $productId = $request->input('productid');
            $specifications = [
                'product_id' => $productId,
                'co2_emissions' => $request->input('co2_emissions'),
                'urban_nonurban' => $request->input('urban_nonurban'),
                'euro_status' => $request->input('euro_status'),
                'insurance_group' => $request->input('insurance_group'),
                'security' => $request->input('security'),
                'speed' => $request->input('speed'),
                'top_speed' => $request->input('top_speed'),
                'max_power' => $request->input('max_power'),
                'max_torque' => $request->input('max_torque'),
                'valve_gear' => $request->input('valve_gear'),
                'cyl_arr' => $request->input('cyl_arr'),
                'gears' => $request->input('gears'),
                'aspiration' => $request->input('aspiration'),
                'cylinders' => $request->input('cylinders'),
                'drive_rear' => $request->input('drive_rear'),
                'length' => $request->input('length'),
                'breath' => $request->input('breath'),
                'height' => $request->input('height'),
                'max_gross_weight' => $request->input('max_gross_weight'),
                'towing_weight_braked' => $request->input('towing_weight_braked'),
                'towing_weight_unbraked' => $request->input('towing_weight_unbraked'),
                'seats' => $request->input('seats'),
                'adult' => $request->input('adult'),
                'child' => $request->input('child'),
                'pedestrian' => $request->input('pedestrian'),
                'safety_assist' => $request->input('safety_assist'),
                'overall' => $request->input('overall'),
            ];
            
        // // Process the uploaded images and store them in the database
        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $file) {
                // Generate a unique filename for each image
                $filename = time() . '_' . $file->getClientOriginalName();

                // Move the uploaded image to the desired directory
                $file->storeAs('gallery', $filename);

                // Create a new product gallery instance and save it to the database
                $gallery = new ProductGallery();
                $gallery->product_id = $productId;
                $gallery->image = $filename;
                $gallery->status = 1; // Assuming 1 is the default status for a gallery image
                $gallery->save();
            }
        }
    
        // Save specifications
       

        specifications::insert($specifications);

        // Redirect back or to a specific route after the gallery images are saved
        return redirect()->back()->with('success', 'Gallery images have been added successfully.');
    }

    public function reviewRemove($id) {
        $review = Review::findOrFail($id);
        $review->delete();

        $product     = Product::with('reviews')->findOrFail($review->product_id);

        if($product->reviews->count() > 0){

            $totalReview = $product->reviews->count();
            $totalStar   = $product->reviews->sum('stars');
            $avgRating   = $totalStar / $totalReview;
        }else{
            $avgRating = 0;
        }

        $product->avg_rate = $avgRating;
        $product->save();

        $notify[] = ['success', 'Review remove successfully'];
        return back()->withNotify($notify);
    }

}
