<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Vendor;
use DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {

      $Cat = MainCategory::Selection()->wheree()->get();



       return view('admin.MainCategories.index',compact('Cat'));
    }
    public function create()
    {
        return view('admin.MainCategories.create-Cat');

    }
    public function save(MainCategoryRequest $request )
    {
        try {

        DB::beginTransaction();
        $Main_Category = collect($request-> category);
        $filter = $Main_Category->filter(function ($value,$key){
            return $value['abbr']== get_default_language();
        });
        $default_category = array_values($filter->all())[0];
        $path="";
        if($request->has('photo')) {
            $path = uploadImage('MainCategories', $request->photo);
        }

       $default_category_id =  MainCategory::insertGetId([
            'translation_lang'=>$default_category['abbr'],
            'translation_of'=>0,
            'name'=>$default_category['name'],
            'slug'=>$default_category['name'],
            'photo'=>$path,

        ]);
       $categories = $Main_Category->filter(function ($value,$key){
            return $value['abbr']!= get_default_language();
        });
       $category_arr=[];
       if($categories&&$categories->count()>0)
       {
           foreach ($categories as $category) {
               $category_arr[]=[
                   'translation_lang'=>$category['abbr'],
                   'translation_of'=>$default_category_id,
                   'name'=>$category['name'],
                   'slug'=>$category['name'],
                   'photo'=>$path,
               ];
           }
           MainCategory::insert($category_arr);

       }
       DB::commit();
            return redirect()->route('admin.MainCat')->with(['success'=>"تم اضافه القسم بنجاح "]);
        }
        catch(\Exception $ex){
            DB::rolleback();
            return redirect()->route('admin.MainCat')->with(['error'=>$ex]);
        }
    }
    public function edit($mainCat_id)
    {
        $mainCategory =  MainCategory::with('categoriess')->Selection()->find($mainCat_id);

        if(!$mainCategory)
        {
            return redirect()->route('admin.MainCat')->with(['error'=>"هذا القسم غير موجود "]);

        }
        return view('admin.MainCategories.edit',compact('mainCategory'));

    }
    public function update($id,MainCategoryRequest $request)
    {

        try{
        DB::beginTransaction();

       $Category =  MainCategory::find($id);
       if(!$Category)
           return redirect()->route('admin.MainCat')->with(['error'=>"هذا القسم غير موجود "]);
       //update
        $cat = array_values($request -> category)[0];
        if(!$request->has('category.0.active'))
            $request->request->add(['active'=>0]);
        else
            $request->request->add(['active'=>1]);

            $categories = MainCategory::where('id',$id)->update([
            'name'=>$cat['name'],
            'active'=>$request->active,
        ]);

          ###############  //update Photo//###############

            $filepath="";
            if($request->has('photo')) {
                $filepath = uploadImage('MainCategories', $request->photo);
                $categories = MainCategory::where('id', $id)->update([
                    'photo' => $filepath
                ]);
            }
    DB::commit();
        return redirect()->route('admin.MainCat')->with(['success'=>'تم تعديل القسم بنجاح ']);



    }
            catch(\Exception $ex)
            {
                //DB::rolleback();

            }
    }
    public function destroy($id)
    {
        try{
           $cat = MainCategory::find($id);
           if(!$cat)
           {
               return redirect()->route('admin.MainCat')->with(['error'=>'هذا القسم غير موجود او محذوف']);

           }
           $vendors = $cat -> vendors;
           if(isset($vendors) && $vendors -> count()>0)
           {
               return redirect()->route('admin.MainCat')->with(['error'=>'هذا القسم مرتبط به متاجر عديدة -- لايمكن حذفه--']);

           }
           else
               {

                 $image =  Str::after($cat->photo,'assets/');
                 $image = base_path('public/assets/'.$image);
                 unlink($image);
                 $cat -> delete();
                 $cat->categoriess()->delete();
                 return redirect()->route('admin.MainCat')->with(['success'=>'تم حذف القسم بنجاح ']);

               }

        }
        catch(\Exception $ecxeption)
        {

            return redirect()->route('admin.MainCat')->with(['error'=>'حدث خطا ما  ']);

        }

    }
    public function changeStatus($id)
    {
                try
                {
                $cat = MainCategory::find($id);
                if(!$cat)
                {
                    return redirect()->route('admin.MainCat')->with(['error'=>'هذا القسم غير موجود او محذوف']);

                }
                $status = $cat->active == 1 ? 0 : 1;
               $cat->update(['active'=>$status]);
                return redirect()->route('admin.MainCat')->with(['success'=>'تم تغير حالة القسم بنجاح ']);


                }
        catch(\Exception $ex)
            {

            }

    }


}
