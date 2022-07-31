@extends('plantilla')

@section('content')
  <div id="root" class="container_12">
    <div v-if="loading" class="loading-container">
      <div class="loading-animation"></div>
    </div>
    <div class="grid_12">
      <h2>Contactos</h2>
    </div>
    <div v-if="canAddContact()" class="grid_12" v-cloak>
      <div class="custom-title">
        <div><a href="{{ url('/registrar-contacto') }}">Agregar un contacto >></a></div>
      </div>
    </div>
    <div class="clear"></div>
    <div v-cloak>
    <ul class="pets-grid" v-if="records.length > 0">
      <li class="pet-box-grid" v-for="(item, index) in records">                   
          <div class="pet-box">
            <div class="item-content">@{{ item.nombre | capitalize }}</div>
            <div class="label">nombre</div>
          </div>   
          <div class="pet-box">
            <div class="item-content">@{{ item.correo_electronico }}</div>
            <div class="label">correo</div>
          </div>  
          <div class="pet-box">
            <div class="item-content">@{{ item.telefono }}</div>
            <div class="label">teléfono</div>
          </div>   
          <div class="pet-box">
            <div class="item-content">@{{ item.ciudad }}</div>
            <div class="label">ciudad</div>
          </div>   
          <div class="pet-box">
            <div class="item-content">@{{ item.sitio_web }}</div>
            <div class="label">sitio web</div>
          </div>   
          <div class="pet-box">
            <div class="item-content">@{{ item.requisitos_previos }}</div>
            <div class="label">requisitos previos</div>
          </div>   
          <div class="pet-box">
            <div class="item-content">@{{ getTipos(item.tipo_animales) }}</div>
            <div class="label">puede recibir</div>
          </div>        
      </li>
    </ul>
  </div>
  </div>
@endsection

@section('scripts')
<script>
    var app = new Vue({
      el: '#root',
      data: {
        loading: true,
        recordsOne: [],
        records: [],
        appUrl: null
      },
      mounted() {       
        this.appUrl = localStorage.url;       
        this.loadData();
      },
      methods: {
        loadData: function() {
          this.$http.get(
            `${localStorage.url}/api/contactos`
          ).then(function (response) {
            this.records = response.data.data;
            this.loading = false;
          }, function (err) {
            catchErrors(err);
          });
        },
        getTipos: function(tiposArray) {
          if(!tiposArray) return;
          const tipos = tiposArray.map(o => o.id)        
					return tipos.join(",");
				},
        canAddContact: function() {
          const permissions = localStorage.permissions || []; 
          return permissions.includes("agregar_contacto");
				}
      }
    });
</script>
@stop


@push('css-styles')
  <style type="text/css">  
    .custom-title {
      font-size: 15px;
      padding-bottom: 20px;
    }

    .pets-grid {
      display:grid;
      grid-template-columns: repeat(1, 1fr);
      row-gap: 8px;
    }

    .pet-box-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      border-bottom: 1px solid #efe6e6;
    }

    .pet-box {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .item-content{
      font-size:13px;
    }

    .label {
      color: #c3bdb7;
      font-size: 11px;
    }

  </style>
@endpush