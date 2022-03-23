<?php

namespace App\Http\Controllers\definition;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);
        return view('definition.product.Index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('definition.product.create', [
            'product' => new Product(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->rules();
        $request->validate($rules);
        $data = $request->except('image');
        if ($request->favare === 'on') {
            $data['favare'] = true;
        } else {
            $data['favare'] = false;
        }

        $data['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $data['image'] = $file->store('public/images');
            }
        }
        $product = Product::create($data);

        return redirect()->route('products.index')->withSuccessMessage('تم اضافة المنتج بنجاح');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::findOrFail($id);
        return view('definition.product.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $rules = $this->rules();
        $request->validate($rules);
        $product = Product::findOrFail($id);
        $data = $request->except('image');
        if ($request->favare === 'on') {
            $data['favare'] = true;
        } else {
            $data['favare'] = false;
        }
        $old_image = $product->image;
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            if ($file->isValid()) {
                $data['image'] = $file->store(
                    'public/images'

                );
            }
        }
        $product->update($data);

        // dd($category->image);
        if ($old_image && $old_image != $product->image) {
            Storage::delete($old_image);
        }
        return redirect()->route('products.index')->withSuccessMessage('تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        if ($product->image) {
            Storage::delete($product->image);
        }
        return redirect()->route('products.index')->withSuccessMessage('تم حذف المنتج بنجاح');
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'barcode' => ['nullable', 'string', 'unique:products,barcode'],
            'price' => ['required'],
            'image' => 'nullable|image'

        ];
    }
    public function barcode($barcode)
    {
        $product = Product::where('barcode', $barcode)->first();
        if ($product) {
            return $product;
        }
        abort(404);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('user_id', Auth::id())
            ->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('price', 'LIKE', "%{$search}%")
                    ->orWhere('quantity', 'LIKE', "%{$search}%");
            })
            ->paginate(5);
        return view('definition.product.Index', [
            'products' => $products,
        ]);
    }
}
