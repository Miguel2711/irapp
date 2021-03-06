@section('css_links')
<link rel="stylesheet" href="{{ asset('css/addons/select2.css') }}" type="text/css"/>
@endsection
@section('crud_form')

@if($editar)
<form id="categoria_form" method="POST" action="{{ route('categorias.update',$categoria->id) }}" accept-charset="UTF-8">
    <input name="_method" type="hidden" value="PUT">
    @else
    <form id="categoria_form" method="POST" action="{{ route('categorias.store') }}" accept-charset="UTF-8">
@endif

 {{ csrf_field() }}
    <!-- Grid row -->
    <div class="form-row">
        <!-- Grid column -->
        <div class="col-md-6">
            <!-- Material input -->
            <div class="md-form">
    <i class="fas fa-sitemap prefix"></i>
    <input type="text" required id="nombre" value="{{ old('nombre') ? old('nombre') : $categoria->nombre}}" name="nombre" class="form-control validate" maxlength="50">
    <label for="nombre" data-error="Error" data-success="Correcto">Nombre *</label>
</div>
@if ($errors->has('nombre'))
                                            <div class="hoverable waves-light alert alert-danger alert-dismissible fade show" role="alert">
                                           {{ $errors->first('nombre') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                                
                                @endif
        </div>
        <!-- Grid column -->
 <div class="col-md-6">
    <!-- Material input -->

 <input {{ (old('raiz')) ? 'checked' : ( $categoria->categoria == NULL  ? "checked" : "") }} type="checkbox" id="raiz" name="raiz" class="switch-input">
    <label for="raiz" class="switch-label">Categoria raiz *: <span class="toggle--on">Si</span><span class="toggle--off">No</span></label>
@if ($errors->has('raiz'))
                                    <div class="hoverable waves-light alert alert-danger alert-dismissible fade show" role="alert">
                                   {{ $errors->first('raiz') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
                        
                        @endif
</div>
<!-- Grid column -->
        </div>
    <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-row">


        <!-- Grid column -->
        <div class="col-md-6">
            <!-- Material input -->
            <div id="especialidad_div">
            <div class="md-form">
            <i class="fas fa-balance-scale"></i>
            <small for="especialidad_id">Especialidades *</small>   
    <select class="form-control" required id="especialidad_id" name="especialidad_id">
    <option value="" disabled selected>Selecciona una opción</option>
    @foreach($especialidades as $key => $especialidad)
    <option {{ old('especialidad_id') ?  ((old('especialidad_id') == $especialidad->id) ? 'selected' : '') : (($categoria->especialidad->id==$especialidad->id)?'selected':'') }} value="{{$especialidad->id}}">{{$especialidad->nombre}}</option>
    @endforeach
</select>
</div> @if ($errors->has('especialidad_id'))
                                            <div class="hoverable waves-light alert alert-danger alert-dismissible fade show" role="alert">
                                           {{ $errors->first('especialidad_id') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                                
                                @endif
                            </div>

                              <!-- Material input -->
            <div id="categoria_div">
                <div class="md-form">
                <i class="fas fa-sitemap"></i>
                <small for="categoria_id">Categorias *</small>   
                @include('include.clasificacion.categorias_parent.select', array('categoria_selected'=>$categoria))
    </div> @if ($errors->has('categoria_id'))
                                                <div class="hoverable waves-light alert alert-danger alert-dismissible fade show" role="alert">
                                               {{ $errors->first('categoria_id') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
                                    
                                    @endif
                                </div>
        </div>
        <!-- Grid column -->
        </div>
    <!-- Grid row -->

    <a onclick="validar()" class="waves-effect btn {{($editar) ? 'btn-warning' : 'btn-success'}} btn-md hoverable">
    <i class="fas fa-2x {{($editar) ? 'fa-pencil-alt' : 'fa-plus'}}"></i> {{($editar) ? 'Editar' : 'Registrar'}}
    </a>
</form>
@endsection
@section('js_links')
<script type="text/javascript" src="{{ asset('js/addons/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/i18n/es.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/addons/validation/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/addons/validation/messages_es.js') }}"></script>
<script type="text/javascript">

function validar(){
  if($("#categoria_form").validate({
    lang: 'es',
    errorPlacement: function(error, element){
      $(element).parent().after(error);
		}})){
    $("#categoria_form").submit();
  }
  }

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$('#especialidad_id').select2({
        placeholder: "Especialidades",
        theme: "material",
        language: "es"
    });

    $('#categoria_id').select2({
        placeholder: "Categorias",
        theme: "material",
        language: "es"
    });
    $(".select2-selection__arrow")
        .addClass("fas fa-chevron-down");

         $(document).ready(function(){
if($("#raiz").prop("checked") == true) {
	$("#especialidad_div").slideDown('fast');
		$('#especialidad_id').attr( 'required', true );
		$("#categoria_div").slideUp('fast');
		$('#categoria_id').attr( 'required', false );     
    }else{
		$("#especialidad_div").slideUp('fast');
		$('#especialidad_id').attr( 'required', false );
		$("#categoria_div").slideDown('fast');
		$('#categoria_id').attr( 'required', true );  
	}
});
$("#raiz").change(function() {
    if(this.checked) {
		$("#especialidad_div").slideDown('fast');
		$('#especialidad_id').attr( 'required', true );
		$("#categoria_div").slideUp('fast');
		$('#categoria_id').attr( 'required', false );
    }else{
		$("#especialidad_div").slideUp('fast');
		$('#especialidad_id').attr( 'required', false );
		$("#categoria_div").slideDown('fast');
		$('#categoria_id').attr( 'required', true );  
	}
});
</script>
@endsection
