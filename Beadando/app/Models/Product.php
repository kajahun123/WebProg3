<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'content', 'type_id', 'publisher_id', 'price',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function getHasCoverAttribute(){
        return $this->cover != null;
    }

    public function getCoverImageAttribute(){
        if($this->has_cover){
            return asset("upload/products/{$this->cover}");
        }
        return "https://actar.com/wp-content/uploads/2015/12/nocover.jpg";
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->orderBy('created_at', 'desc');
    }
}
