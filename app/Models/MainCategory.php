<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $table = 'main_categories';
    protected $fillable = [
        'translation_lang',
        'translation_of',
        'name',
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
        return $query -> select('id','translation_lang','name','slug','active','photo','translation_of');
    }
    public function getActive()
    {
        return $this->active == 1?'مفعل':'غير مفعل';
    }
    public function getPhotoAttribute($val)
    {
        return $val!==null? asset('/assets/admin/'.$val):"";
    }
	
	//get all translation categories
	
    public function categoriess()
    {
        return $this->hasMany(self::class,'translation_of');
    }
    public function vendors()
    {
        return $this->hasMany('App\Models\Vendor','category_id','id');
    }

    protected static function boot()
    {
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);

    }
	public function scopeDefaultCategory($query)
	{
		return $query->where('translation_lang',get_default_language());
		
	}
	
	//get all subcategories
	
	public function subCategory()
	{
		return $this->hasMany('App\Models\SubCategory','main_category_id','id');
	}


}
