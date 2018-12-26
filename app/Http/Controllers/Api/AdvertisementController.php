<?php

namespace App\Http\Controllers\Api;

use App\Advertisement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdvertisementController extends Controller
{
    //
    public function slider()
    {
        //minus the duration left
        foreach (Advertisement::all() as $advertisement)
        {
            if($advertisement->chosen_time != NULL)
            {
                $diff = Carbon::now()->diffInDays($advertisement->chosen_time);

                if($diff >= $advertisement->duration_left)
                {
                    $advertisement->duration_left = 0;
                    $advertisement->is_used = 0;
                }
                else {
                    $advertisement->duration_left = $advertisement->duration_left - $diff;
                }

                $advertisement->chosen_time = NULL;
            }
            $advertisement->save();
        }

        $sliders = Advertisement::inRandomOrder()->where('is_used', '=', 2)->take(3)->get();

        foreach($sliders as $slider)
        {
            $slider->chosen_time = Carbon::now();
            $slider->save();
        }

        return $sliders;

    }

    public function rotation()
    {
        //minus the duration left
        foreach (Advertisement::all() as $advertisement)
        {
            if($advertisement->chosen_time != NULL)
            {
                $diff = Carbon::now()->diffInDays($advertisement->chosen_time);

                if($diff >= $advertisement->duration_left)
                {
                    $advertisement->duration_left = 0;
                    $advertisement->is_used = 0;
                }
                else {
                    $advertisement->duration_left = $advertisement->duration_left - $diff;
                }
                $advertisement->chosen_time = NULL;
            }
            $advertisement->save();
        }

        $rotations = Advertisement::inRandomOrder()->where('is_used', '=', 1)->take(1)->get();

        foreach($rotations as $rotation)
        {
            $rotation->chosen_time = Carbon::now();
            $rotation->save();
        }

        return $rotations;
    }
}
