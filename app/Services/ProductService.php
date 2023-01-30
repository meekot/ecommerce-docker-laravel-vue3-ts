<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService 
{

  public function saveImage(UploadedFile $image): string
  {
      $imageName = sprintf('%s.%s', Str::random(), $image->getClientOriginalExtension());
      $disk = Storage::disk(Product::IMAGE_DISK);
      if (!$disk->directoryExists(Product::IMAGE_PATH)) {
          $disk->makeDirectory(Product::IMAGE_PATH);
      }

      if (!$disk->putFileAs(Product::IMAGE_PATH, $image, $imageName)) {
          throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
      }

      return $imageName;
  }

  public function removeImage(string $imageName)
  {
    $disk = Storage::disk(Product::IMAGE_DISK);
    $path = sprintf('%s/%s', Product::IMAGE_PATH, $imageName);
    $disk->delete($path);
  }
}