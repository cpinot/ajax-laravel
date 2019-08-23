<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Juego Test Ajax</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        .box{
          width: 600px;
          margin:0 auto;
          border:1px solid #ccc;
        }
    </style>
  </head>
  <body>
  <div class="container box">
    <h3 aling="center">Listado de Usuario</h3><br />
    <div class="form-group">
      <select class="form-control input-lg dynamic" name="serie" id="serie" data-dependent="question">
        <option value="">Seleccione la serie a Jugar</option>
        @foreach($serie_list as $serie)
          <option value="{{$serie->id}}">{{$serie->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <select class="form-control input-lg dynamic" name="question" id="question" data-dependent="answer">
        <option value="">Seleccione la pregunta</option>
      </select>
    </div>
    <div class="form-group">
      <select class="form-control input-lg dynamic" name="answer" id="answer" >
        <option value="">Seleccione la Respuesta</option>
     </select>
    </div>

    {{csrf_field()}}
    <br />
    <br />

  </div>
  </body>
</html>
<script>
$(document).ready(function(){
  $('.dynamic').change(function(){
    if($(this).val()!=''){
      var select=$(this).attr("id");
      var value=$(this).val();
      var dependent=$(this).data('dependent');
      var _token=$('input[name="_token"]').val();
      $.ajax({
        url:"{{route('dynamicdependent.fetch')}}",method:"POST",data:{select:select, value:value, _token:_token, dependent:dependent},success:function(result)
        {
          $('#'+dependent).html(result);
        }
      });
    }
  });
  $('#serie').change(function(){
    $('#question').val('');
    $('#answer').val('');
  });
  $('#question').change(function(){
   $('#answer').val('');
  });

});
</script>
