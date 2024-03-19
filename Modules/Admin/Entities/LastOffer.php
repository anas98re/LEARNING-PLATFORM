<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class LastOffer extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['offer_image' , 'offer_text'];
    public $translatable = ['offer_text'];
    protected $table = 'last_offers' ; 
    protected static function newFactory()
    {
        return \Modules\Admin\Database\factories\LastOffersFactory::new();
    }
}
