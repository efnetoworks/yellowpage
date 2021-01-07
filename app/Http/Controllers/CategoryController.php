<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Service;
use App\State;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use DB;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->paginate(5);
        return view ('admin/category/index', compact('category') );
    }

    public function allCategories()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(12);
        return view ('allCategories', compact('categories') );
    }

    public function categoryDetail($id)
    {


         $category = Category::find($id);
        $categories = Service::where('id', $id)->get();
                //return 'categories'; 

        //return view ('categoryDetails', compact('categories') ); 

        
        $categories = Category::orderBy('id', 'desc')->paginate(12);
        return view ('allCategories', compact('categories') );
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $this->validate($request,[
            'name' => ['required', 'unique:categories'],
        ]); 

        $slug = Str::of($request->name)->slug('-');

        $category = new Category();
                // Image set up
        if ( $request->hasFile('file') ) {
                $names = [];
foreach($request->file('image') as $image)
    {
        $image_name = time().'.'.$request->file->extension();
        $request->file->move(public_path('images'),$image_name);
        array_push($names, $filename);          
        //$category->image = $image_name;
        }
            $category->image = json_encode($names)

}

/*if($request->hasFile('image'))
{
    $names = [];
    foreach($request->file('image') as $image)
    {
        $destinationPath = 'content_images/';
        //$filename = $image->getClientOriginalName();
        //$image->move($destinationPath, $filename);
        array_push($names, $filename);          

    }
    $content->image = json_encode($names)
}
*/









        $category->name = $request->name;
        $category->slug = $slug;
        $category->save();

        $request->session()->flash('status', 'Task was successful!');

        return $this->index();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //$service = Service::find($id);
      //$service_slug = $service->slug;//
        
        $one_category = Category::where('slug', $slug)->first();
        $category_id = $one_category->id;
        $category_services = Service::where('category_id', $category_id)->get();
        //return $category_services;
        //$category_city = Service::all()->pluck("city");
        $category_city = Service::all();
        $all_states = State::all();
        $toShowOtherSearch = null;
        $all_categories = Category::all();
        $featuredServices = Service::where('is_featured', 1)->with('user')->inRandomOrder()->limit(4)->get();
        //$category_id = $id;
        //return $category_city;

        return view ('services', compact('category_services', 'toShowOtherSearch', 'one_category', 'category_city', 'all_categories', 'all_states', 'featuredServices') );        
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::find($slug);
        return view ('admin/dashboard/category/edit', compact('category') );        
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
        
       $this->validate($request,[
            'name' => 'required',
        ]); 

        $category->name = $request->name;

        $category->save();

        $request->session()->flash('success', 'Task was successful!');
        return 'success';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $category = Category::findOrFail($id);
        $category->delete();
        session()->flash('success', 'Task was successful!');
        return $this->index();

    }




  //For fetching all countries
public function getStates()
{
    $states = DB::table("states")->get();
    return view('index')->with('states',$states);
}




//For fetching cities
public function getlocal_governments($id)
{
    $local_governments= DB::table("local_governments")
                ->where("state_id",$id)
                ->pluck("name","id");
    return response()->json($local_governments);
}



  public function getCityList($id)
    {
        $cities = DB::table("local_governments")
                    ->where("state_id",$id)
                    ->pluck("name","id");
        return response()->json($cities);
    }



    public function getCategoryList($id)
    {
        $sub_categories = DB::table("sub_categories")
                    ->where("category_id",$id)
                    ->pluck("name","id");
        return response()->json($sub_categories);
    }

}
