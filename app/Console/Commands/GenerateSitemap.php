<?php
namespace App\Console\Commands;

use App\Models\gallery_cat;
use App\Models\news;
use App\Models\news_cat;
use App\Models\product;
use App\Models\product_cat;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */


    public function handle()
    {
        $sitemap=Sitemap::create();

        $modeles= [
            news::class,
            news_cat::class,
            product::class,
            product_cat::class,
            gallery_cat::class
        ];
      
        foreach($modeles as $value){
            ($value)::get()->each(function ($item) use ($sitemap) {
                $sitemap->add(Url::create(urldecode($item->url))
                    ->setLastModificationDate(Carbon::yesterday())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->addImage(asset("upload/thumb1/".$item->pic),$item->alt_image ?? $item->title)
                    ->setPriority(0.9)
                );
            });
        };

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
