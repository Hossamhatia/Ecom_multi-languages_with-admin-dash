<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\languageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class LanguagesController extends Controller
{
    public function index()
    {
        $languages = Language::Select()->paginate(PAGINATION_COUNT);
        return view('admin.Languages.index',compact('languages'));
    }
    public function create(){
        return view('admin.Languages.create-lang');
}
    public function save(languageRequest $request)
    {
        try{
            if(!$request->has('active'))
                $request->request->add(['active'=>'0']);
            $lang = new Language();
            $lang->name = $request->name;
            $lang->abbr = $request->abbr;
            $lang->direction = $request->direction;
            $lang->active = $request->active;
            $lang->save();
            return redirect()->route('admin.language')->with(['success'=>'تم اضافه اللغه بنجاح ']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.language')->with(['error'=>'حدث خطأ فى  اضافه اللغه  ']);

        }


    }
    public function edit($id)
    {
        $language = Language::Selection()->find($id);
        if(!$language)
        {
            return redirect()->route('admin.language')->with(['error'=>'هذة اللغه غير موجودة']);
        }
        return view('admin.Languages.edit',compact('language'));

    }
    public function update($id,languageRequest $request)
    {
        try {
        $language = Language::find($id);
        if(!$language)
        {
            return redirect()->route('edit.language',$id)->with(['error'=>'هذة اللغه غير موجودة']);
        }
            if(!$request->has('active'))
                $request->request->add(['active'=>'0']);
            $language ->update($request->except('_token'));
            return redirect()->route('admin.language')->with(['success'=>'تم تعديل اللغه بنجاح ']);


        }
        catch(\Exception $ex){
            return redirect()->route('admin.language')->with(['error'=>'حدث خطأ فى  اضافه اللغه  ']);

        }


    }
    public function destroy($id)
    {
        try {
            $language = Language::find($id);
            if(!$language)
            {
                return redirect()->route('admin.language',$id)->with(['error'=>'هذة اللغه غير موجودة']);
            }

            $language ->delete();
            return redirect()->route('admin.language')->with(['success'=>'تم حذف اللغه بنجاح ']);


        }
        catch(\Exception $ex){
            return redirect()->route('admin.language')->with(['error'=>'حدث خطأ فى  اضافه اللغه  ']);

        }

    }

}
