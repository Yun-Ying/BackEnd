<?php

    use App\Advertisement;
    use Illuminate\Database\Seeder;

class AdvertisementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Advertisement::truncate();

        //5 default advertisement that cant be modified
        $name = ['youtube', 'facebook', 'instagram', 'snapchat', 'ntust'];
        $url = ['https://www.youtube.com/', 'https://www.facebook.com/', 'https://www.instagram.com/?hl=en', 'https://www.snapchat.com/', 'https://www.ntust.edu.tw/home.php'];
        $is_used = [1, 1, 2 ,2 ,2];

        for($i=0; $i<5; $i++)
        {
            Advertisement::create([
                'name' => $name[$i],
                'url' => $url[$i],
                'is_used' => $is_used[$i],
                'file_path' => 'http://localhost:8000/storage/advertisements/advertisement'.($i+1).'.jpg',
                'duration_left' => 50,
            ]);
        }
    }
}
