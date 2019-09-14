<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   public function getUser(){
       
       return $this->hasOne(User::class,'id','user_id');
       
   }
   public function getUnit(){
       
       return $this->hasOne(Unit::class,'id','unit_id');
       
   }
   public function getCategory(){
       
       return $this->hasOne(Category::class,'id','cat_id');
       
   }
   
   public function getFeaturedImage(){
       return $this->hasOne(ProductImages::class,'product_id','id')->where('is_featured','1');
   }
   
   public function getProuctImages(){
       return $this->hasMany(ProductImages::class,'product_id','id')->where('is_featured','0');
   }
}
