<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use AuthenticatesUsers;
class productController extends Controller
{
    //Add product 
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function addproduct()
    {

        return view("addproduct");
    }

    public function addnewproduct(Request $request)
    {
        $collect = $request->all();
//dd($collect);
        $baseFile = $collect['image'];

        $file = $baseFile->getClientOriginalName();
        $fileName = Str::slug(pathinfo($file, PATHINFO_FILENAME));
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $folder_path = storage_path('app/public');
        $fullName = $fileName . '__' . \Carbon\Carbon::now()->timestamp . '.' . $extension;
        $baseFile->move($folder_path, $fullName);
        $collect['image'] = $fullName;

        unset($collect['_token']);

        $data_insert = DB::table('product_table_custom')->insert($collect);
        return redirect()->to("manageproduct")->with('success', 'product Added Successfully!!!!!');
    }

        public function manageproduct(Request $request)
    {  
      $collect = $request->input('search');
 
   
       if (!empty($collect)) {
        //dd($collect);
         
          $request = DB::table('product_table_custom')->where('id', 'LIKE', "%{$collect}%")->orWhere('title', 'LIKE', "%{$collect}%") ->get();
       }
      else{
        
           
        $request = DB::table('product_table_custom')->orderBy("id", 'desc')->get();
      }
      
      
        return view("manageproduct", ['request' => $request, 'collect' => $collect]);

    }
    public function productdestroy($id)
    {
        //DB::delete('delete from banner where id = ?', [$id]);
        DB::table('product_table_custom')->where('id', $id)->delete();
        return back()->with('deleted', 'Product Deleted Successfully');

    }

    public function editproduct($id)
    {
        $data = DB::table('product_table_custom')->where('id', $id)->get()->first();

        return view('editproduct', ['data' => $data]);

    }

    public function productedit(Request $request, $id)
    {
        $collect = $request->all();
        // dd($collect);

        if (!empty($collect['image'])) {
            $baseFile = $collect['image'];
            $file = $baseFile->getClientOriginalName();
            $fileName = Str::slug(pathinfo($file, PATHINFO_FILENAME));
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $folder_path = storage_path('app/public');
            $fullName = $fileName . '__' . \Carbon\Carbon::now()->timestamp . '.' . $extension;
            $baseFile->move($folder_path, $fullName);
            $collect['image'] = $fullName;
            // dd($collect);

        } else {
            $data = DB::table('product_table_custom')->where('id', $id)->get()->first();
            $collect['image'] = $data->image;
        }
        unset($collect['_token']);
        DB::table('product_table_custom')->where('id', $id)->update($collect);

        return back()->with('Success', 'Product Altered Successfully');
    }
}
