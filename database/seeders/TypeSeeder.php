<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Front end', 'Back end', 'Full stack'];

        foreach($types as $type) {
            $newType = new Type();
            $newType->name = $type;
            $newType->slug = Str::of($type)->slug('-');
            $newType->save();
        }
    }
}
