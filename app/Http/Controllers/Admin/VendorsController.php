<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
//use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorCreated;
use Illuminate\Support\Str;

class VendorsController extends Controller
{
    public function index()
    {
        $vendors = Vendor::selection()->paginate(PAGINATION_COUNT);
        return view('admin.Vendors.index',compact('vendors'));

    }
    public function create()
    {
        $categories = MainCategory::where('translation_of',0)->active()->get();
        return view('admin.Vendors.create',compact('categories'));
    }
    public function save(VendorRequest $request)
    {
        if(!$request->has('active'))
            $request->request->add(['active'=>0]);
        else
            $request->request->add(['active'=>1]);
        $filepath="";
        if($request->has('logo'))
        {
            $filepath = uploadImage('Vendors', $request->logo);

        }
        try
        {
            $vendor = Vendor::create([
                'name'=>$request->name,
                'category_id'=>$request->category_id,
                'mobile'=>$request->mobile,
                'email'=>$request->email,
                'active'=>$request->active,
                'address'=>$request->address,
                'password'=>$request->password,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
                'logo'=>$filepath,
                         ]);
            Notification::send($vendor, new VendorCreated($vendor));
            return redirect()->route('admin.vendors')->with(['success'=>'تم حفظ المتجر بنجاح ']);


        }
        catch(\Exception $ex )
        {
            return $ex;
           // return redirect()->route('admin.vendors')->with(['error'=>'حدث خطأ ما']);


        }



    }
    public function edit($id)
    {
        try
        {
          $vendor =  Vendor::selection()->find($id);
           $categories = MainCategory::where('translation_of',0)->active()->get();
          if(!$vendor)
          {
              return redirect()->route('admin.vendors')->with(['error'=>'هذا المتجر غير موجود او ربما يكون محذوفا']);
          }
          return view('admin.Vendors.Edit',compact('vendor','categories'));

        }
        catch(\Exception $ex)
        {
			  return redirect()->route('admin.vendors')->with(['error'=>'حدث خطأ ما']);


        }

    }
    public function update($id,VendorRequest $request)
    {
        try {

            $vendors = Vendor::find($id);
            if(!$vendors)
            {
                return redirect()->route('admin.vendors')->with(['error'=>'هذا المتجر غير موجود او ربما يكون محذوفا']);

            }
            DB::beginTransaction();
            if(!$request->has('active'))
            {
                $request->request->add(['active'=>0]);
            }
            else{
                $request->request->add(['active'=>1]);

            }
            //update logo
            $filepath="";
            if($request->has('logo')) {
                $filepath = uploadImage('Vendors', $request->logo);
                $vendors = Vendor::where('id', $id)->update([
                    'logo' => $filepath
                ]);
            }
            $data=$request->except('_token','password','logo','id');
            if($request->has('password'))
            {
                $data['password']=$request->password;
            }
            Vendor::where('id',$id)
                ->update($data);




            DB::commit();
            return redirect()->route('admin.vendors')->with(['success'=>'تم تعديل المتجر بنجاح ']);

        }catch(\Exception $exption)
        {
            DB::rollback();
            return redirect()->route('admin.vendors')->with(['error'=>'حدث خطأ ما']);

        }

    }

    public function delete($id)
    {
        try {
            $vendors = Vendor::find($id);
            if(!$vendors)
            {
                return redirect()->route('admin.MainCat')->with(['error'=>' هذا المتجر غير موجود او محذوف']);

            }
            $image =  Str::after($vendors->logo,'assets/');
            $image = base_path('public/assets/'.$image);
            unlink($image);
            $vendors->delete();
            return redirect()->route('admin.vendors')->with(['success'=>'تم حذف المتجر بنجاح ']);


        }
        catch(\Exception $ex)
        {
            return redirect()->route('admin.vendors')->with(['error'=>'حدث خطأ ما']);


        }

    }


    public function changeStatus($id)
    {
        try {
            $change = Vendor::find($id);
            $status = $change->active == 1 ? 0 : 1;
            $change->update(['active'=>$status]);
            return redirect()->route('admin.vendors')->with(['success'=>'تم تغير حالة المتجر بنجاح ']);


        }catch(\Exception $ex)
        {
            return redirect()->route('admin.vendors')->with(['error'=>'حدث خطأ ما']);

        }




    }
}
