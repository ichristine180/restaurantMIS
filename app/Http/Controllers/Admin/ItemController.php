<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Item;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        $items = Item::all();
        return view('admin.item.index',compact('items','role','isWaiter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        $categories = Category::all();
        $category = Category::find($id);
        return view('admin.item.create',compact('categories','role','category','isWaiter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:items',
            'description' =>'required',
            'image' => 'required|mimes:jpeg,jpg,png,bmp',
            'price' =>'required',
            'category' =>'required',
        ],[
            'name.unique'=>'item name not available',
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if(isset($image)){

            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentdate.'-'.uniqid().'-'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/item'))
            {
                mkdir('uploads/item',0777,true);
            }
            $image->move('uploads/item',$imagename);
        } else{
            $imagename = 'default.png';
        }

        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->category_id = $request->category;
        $item->image = $imagename;
        $item->save();

        return redirect()->route('viewItem',$request->category)->with('successMsg','Item Successfully Added');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = new User();
        $role = $user->userRole(Auth::User()->role);
        $isWaiter = $user->hasWaiter(Auth::User()->role);
        $item = Item::find($id);
        // $categories = Category::all();
        return view('admin.item.edit',compact('item','role','isWaiter'));
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
        $this->validate($request, [
            'name' => 'required',
            'description' =>'required',
            'price' =>'required',
            'category' =>'required',
        ]);
        $item =Item::find($id);
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if(isset($image)){

            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentdate.'-'.uniqid().'-'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/item'))
            {
                mkdir('uploads/item',0777,true);
            }

            unlink('uploads/item/'.$item->image);

            $image->move('uploads/item',$imagename);
        } else{
            $imagename = $item->image;
        }

        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->category_id = $request->category;
        $item->image = $imagename;
        $item->save();
        return redirect()->route('items')->with('successMsg','Item Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        unlink('uploads/item/'.$item->image);
        $item->delete();
        return redirect()->back()->with('successMsg','Item Successfully Deleted');
    }
}
