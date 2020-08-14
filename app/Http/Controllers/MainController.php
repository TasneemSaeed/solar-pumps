<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getFormPage()
    {
        $pumps = [
            ['model' => '011' , 'voltage' => '24'],
            ['model' => '012' , 'voltage' => '48'],
            ['model' => '013' , 'voltage' => '72'],
            ['model' => '021' , 'voltage' => '24'],
            ['model' => '022' , 'voltage' => '48'],
            ['model' => '023' , 'voltage' => '72']
        ];
        return view('main',compact('pumps'));

    }
    public function calculateCost(Request $r)
    {
        if ($r->pump == 24) {
            if ($r->length >= 1 && $r->length <= 25) {
                return ['cost' =>  round(4.8 * $r->length,2),'unit' => 4.8];
            } else {
                return ['cost' =>  round(6 * $r->length,2),'unit' => 6];
            }
            
        } elseif($r->pump == 48) {
            if ($r->length >= 1 && $r->length <= 34) {
                return ['cost' =>  round(4.8 * $r->length,2),'unit' => 4.8];
            } else {
                return ['cost' =>  round(6 * $r->length,2),'unit' => 6];
            }
        }else{
            if ($r->length >= 1 && $r->length <= 39) {
                return ['cost' =>  round(4.8 * $r->length,2),'unit' => 4.8];
            } else {
                return ['cost' =>  round(6 * $r->length,2),'unit' => 6];
            }
        }
        
    }
}
