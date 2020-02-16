<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <p>
    <?php 
      if(isset($cameras)){
        ?>
          lijst van alle cameras
          <br />
          <ul>  
            @foreach ($cameras as $camera)
              <label for="iets{{$camera->id}}"><li>Merk: {{$camera->cameraMerk}}, type: {{$camera->cameraType}}</li></label>
              <a href='/camera/{{$camera->id}}'><button id='iets{{$camera->id}}' name='iets{{$camera->id}}' >ga naar camera</button></a>
            @endforeach
          </ul>
        <?php
      } else {
        ?>
          wat een kut kamera
          <br />
          Merk: {{$camera->cameraMerk}}, type: {{$camera->cameraType}}
          <br />
          <a href='/camera/{{$camera->id}}/edit'><button id='iets{{$camera->id}}' name='iets{{$camera->id}}'>aanpassen</button></a>
          <form method="POST" action='/camera/{{$camera->id}}'>
            @csrf
            @method('delete')
            <input type='submit' value='delete' name='delete' id='delete'>
          </form>
        <?php
      }
    ?>
    @yield('content')
  </p>
</body>
</html>