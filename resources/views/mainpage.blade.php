<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Photo gallery UI</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <section>
    <div class="container" id="blur">
      <div class="header">
        <h1 class="logo">PhotoGallery</h1>
        <button class="btn" onclick="toggle()">ADD<ion-icon name="add-outline"></ion-icon></button>
      </div>
      
      <div class="gallery">
        @foreach($images as $img)
        <form method="POST" action = "{{action('App\Http\Controllers\ImageController@deleteImage',$img->id)}}">
          @csrf
        <div class="item">
          <a href="{!! url($img->url) !!}">
            <img src="{!! url($img->url) !!}" alt="image">
            <h3>{{$img->title}}</h3>
          </a>
          <button type="submit"><ion-icon  name="trash-outline"></ion-icon></button>
        </div>
        </form>
        @endforeach
      </div>
    </div>
  </section>
  <div id="card">
    <h1>Add Image</h1>
    <a class="close" onclick="toggle()">X</a>
    <form class="popupform" action="/" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" id="title" placeholder="Title Of Image">
        <input type="file" name="image" id="image">
        <button type="submit" class="btn-1">Upload  <ion-icon name="cloud-upload"></ion-icon></button>
    </form>

      


    

</div>
  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
  <script type="text/javascript">
     function toggle(){
         var blur=document.getElementById('blur');
         blur.classList.toggle('active');
         var popup=document.getElementById('card');
         popup.classList.toggle('active')
     }

  </script>
</body>
</html>