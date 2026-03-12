<?php
namespace App\Models;

class Listing_basics{
    public static function all(){
        return [
            [
                'id' => 1,
                'title' => 'Listing One',
                'description' => 'Ah! You want to know how to write multi-line comments in Laravel. Let’s break it down clearly because it depends on where you are commenting — Blade files, PHP code, or JavaScript inside Laravel.'
            ],
            [
                'id' => 2,
                'title' => 'Listing Two',
                'description' => 'Ah! You want to know how to write multi-line comments in Laravel. Let’s break it down clearly because it depends on where you are commenting — Blade files, PHP code, or JavaScript inside Laravel.'
            ],

        ];
    }

    public static function find($id){
        $listings= self::all();
        foreach($listings as $listing){
            if($listing['id']==$id){
            return $listing;
            }
        }
    }
}