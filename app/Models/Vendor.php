<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    //use HasFactory;
    use Notifiable;
    protected $table = 'vendors';
    protected $fillable = [
        'name',
        'mobile',
        'address',
        'email',
        'category_id',
        'active',
        'logo',
        'password',
        'created_at',
        'updated_at',
    ];
    protected $hidden=[
        'category_id','password'
    ];
    public function scopeActive($query)
    {
       return  $query -> where('active',1);
    }
    public function getLogoAttribute($val)
    {
       return  $val!==null?asset('/assets/admin/'.$val):"";
    }
    public function scopeSelection($query)
    {
        return $query->select('id','name','category_id','active','address','latitude','longitude','email','logo','mobile');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\MainCategory','category_id','id');
    }
    public function getActive()
    {
        return $this->active ==1?'مفعل':'غير مفعل';

    }
    public function setPasswordAttribute($password)
    {
        return $this->attributes['password']=bcrypt($password);
    }
}
