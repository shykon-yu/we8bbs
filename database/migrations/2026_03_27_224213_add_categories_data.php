<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [
                "name" => "WRH",
                "description" => "联盟第一战队",
            ],
            [
                "name" => "NO.1",
                "description" => "老牌强队",
            ],
            [
                "name" => "BF",
                "description" => "电信老牌战队",
            ],
            [
                "name" => "AJ",
                "description" => "曾经的王者",
            ]

        ];
        // ✅ 用模型插入 → 自动生成 created_at + updated_at
        foreach ($data as $item) {
            Category::create($item);
        }
        //DB::table('categories')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
};
