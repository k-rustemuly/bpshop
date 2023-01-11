<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "slug",
        "description",
        "category_id",
        "price"
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($product) {
            $product->slug = $product->createSlug($product->name);
            $product->save();
        });
    }

    private function createSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereName($name)->latest("id")->skip(1)->value("slug");
            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($matches) {
                    return $matches[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characteristics()
    {
        return $this->hasMany(ProductCharacteristicValue::class);
    }

    public static function allProduct()
    {
        return Product::query()->postFilter()->get()->all();
    }

    public function scopePostFilter($query)
    {
        $query->when(
            request('category'),
            fn ($query) => $query->where('category_id', request('category'))
        );

        $query->when(
                request('slug'),
                fn ($query) => $query->where('slug', request('slug'))
            );

        $query->when(
            request('sort'),
            fn ($query) => $query->orderBy('name', request('sort'))
        );

        $characteristics = Characteristic::whereIsFilterable(true)->get();
        foreach($characteristics as $characteristic)
        {
            if(request($characteristic->code))
            {
                $request = [
                    $characteristic->code => request($characteristic->code)
                ];
                $validator = Validator::make($request, [
                    $characteristic->code => $characteristic->validation,
                ]);
                foreach($validator->validated() as $field)
                {
                    $value = $field;
                    $query->with('characteristics')
                                    ->whereHas('characteristics', function (Builder $query2) use ($characteristic, $value) {
                                        $query2->where('characteristic_id', $characteristic->id)->where('value', $value);
                            });
                }
            }
        }
    }
}
