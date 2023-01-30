<?php

namespace App\Console\Commands\FakeData;

use App\Models\Product;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class FakeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill fake products from https://dummyjson.com';

    // Max 100
    private const LIMIT_PRODUCTS_TO_IMPORT = 50;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Starting to fill Products! Qte products to fill: " . self::LIMIT_PRODUCTS_TO_IMPORT);

        $adminUserId = $this->getAdminUserIdOrFail();



        $client = new Client();
        $request = new Request('GET', sprintf('https://dummyjson.com/products?limit=%d', self::LIMIT_PRODUCTS_TO_IMPORT));
        $response = $client->send($request);


        $products = new Collection(json_decode($response->getBody(), true)["products"]);

        $productsCount = count($products);

        $this->info(
            sprintf(
                "Products was got from sever, qte: %d. Starting to add products to App....",  
                self::LIMIT_PRODUCTS_TO_IMPORT
            )
        );


        $bar = $this->output->createProgressBar($productsCount);


        $disk = $this->getDisk();
        $addedProducts = [];

        foreach ($products as $product) {
            $image = $product["images"][0];

            $imageExt = pathinfo(
                parse_url($image, PHP_URL_PATH), 
                PATHINFO_EXTENSION
            );

            $imageName = sprintf('%s.%s', Str::random(), $imageExt);
            
            $response = $client->request('GET', $image , [
                'sink' => $disk->path(sprintf('%s/%s', Product::IMAGE_PATH, $imageName))
            ]);

            $product = Product::create([
                "created_by" => $adminUserId,
                "updated_by" => $adminUserId,
                "image" => $imageName,
                "image_size" => $response->getHeader('Content-Length')[0],
                "image_mime" => $response->getHeader('Content-Type')[0],
                "title" => $product['title'],
                "description" => $product['description'], 
                "price" => $product['price']
            ]);

            array_push($addedProducts);
            $bar->advance();
        }

        $bar->finish();

        $this->info(sprintf("%d products was added!", count($addedProducts)));
        return Command::SUCCESS;
    }

    private function getAdminUserIdOrFail() 
    {
        /** @var App\Models\User $user */
        $user = User::where('is_admin', '=', true)->first();

        if ($user === null) {
            throw new Exception("Admin user not found");
        }

        return $user->id;
    }

    private function getDisk() {
        $disk = Storage::disk(Product::IMAGE_DISK);

        if (!$disk->directoryExists(Product::IMAGE_PATH)) {
            $disk->makeDirectory(Product::IMAGE_PATH);
        }
        return $disk;
    }
}
