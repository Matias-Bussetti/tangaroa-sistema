@extends('layouts.app')

@section('content')
  <div class="full-height container" style="margin-top: 10px;margin-bottom:40px;">

    <div class="col-md-8 offset-md-2 box border rounded bg-white" style="margin-top:10px">

      <h2 class="h1-modif">Nuevo Programa:</h2>

      <form class="" action="{{action('PackController@store')}}" method="post" style="margin-bottom:30px" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <label for="program_name">Nombre:</label>
          <input type="text" class="form-control texto" name="program_name" value="{{ old('program_name') }}">
          @if ($errors->has('program_name'))
            <div class="error text-danger">
              {{ $errors->first('program_name')}}
            </div>
          @endif
        </div>

        <div class="form-group">
          <label for="program_desc">Descripción:</label>
          <textarea rows="4" cols="50" class="form-control" name="program_desc">{{ old('program_desc') }}</textarea>
        </div>

        <div class="form-group">
          <label for="">Imagen del Programa:</label>
          {{-- <input type="file" name="image_input"> --}}
          <div class="custom-file">
            <input id="image_input" type="file" class="custom-file-input" onchange="readURL(this);" name="image_input" >
            <label class="custom-file-label" for="image_input">Elige una imagen</label>
            @if ($errors->has('image_input'))
              <div class="error text-danger">
                {{ $errors->first('image_input')}}
              </div>
            @endif
          </div>
          <div class=" text-center mt-2">
            <img class="border border-secondary rounded" style="max-width:250px;" id="image" src="http://placehold.it/250" alt="your image" />
          </div>
        </div>

        <script>
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('#image')
              .attr('src', e.target.result);
              // document.getElementById('image_data').value = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
      </script>

      <div class="form-group">
        <div class="" style="margin-top: 2%;">
          <button type="submit" class="btn btn-color btn-submit btn-block" name="btn_submit">Añadir</button>
        </div>
      </div>

    </form>

  </div>

</div>
@stop
