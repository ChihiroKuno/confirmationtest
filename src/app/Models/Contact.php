<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel1',
        'tel2',
        'tel3',
        'address',
        'building',
        'detail',
    ];

    // カテゴリとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function fullName()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    // 性別ラベル（任意で追加済みかも）
    public function getGenderLabelAttribute()
    {
        switch ($this->gender) {
            case 1:
                return '男性';
            case 2:
                return '女性';
            case 3:
                return 'その他';
            default:
                return '不明';
        }
    }
}