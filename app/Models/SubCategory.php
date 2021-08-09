<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
   

    use HasFactory;
    protected $table = 'sub_category';
    protected $fillable = [
        'translation_lang',
        'translation_of',
        'name',
        'parent_id',
        'main_category_id',
        'slug',
        'photo',
        'active',
        'created_at',
        'updated_at',
    ];
    public function scopeActive($query){
        return $query ->where('active',1);
    }
	
    public function scopewheree($query){
        $Default = get_default_language();
        return $query ->where('translation_lang',$Default);
    }
    public function scopeSelection($query){
        return $query -> select('id','translation_lang','name','slug','main_category_id','parent_id','active','photo','translation_of');
    }
    public function getActive()
    {
        return $this->active == 1?'مفعل':'غير مفعل';
    }
    public function getPhotoAttribute($val)
    {
        return $val!==null? asset('/assets/admin/'.$val):"";
    }
	public function maninCategory()
	{
		return $this->belongsTo('App\Models\MainCategory','main_category_id','id');
	}
	
		
}
