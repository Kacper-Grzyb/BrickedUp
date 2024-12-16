# Images info 

- Look at erd to see how images are stored but essentially
- first column is a foreign key with the set number
- second column holds base64 encoded string which when converted is a picture

## Following is an example on how to diplay all images

- Model and migrations should be already pushed 

allimages.blade.php
```html
<div class="container">
    @foreach($images as $image)
    <img src="data:image/jpeg;base64,{{ $image->image_data }}" alt="Image">
    @endforeach
</div>
```

ImageController.php
```php
<?php

namespace App\Http\Controllers;

use App\Models\SetImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $images = SetImage::all();
        return view('allimages', ['images' => $images]);
    }
}
```


