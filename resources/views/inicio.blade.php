@extends('plantilla')

@section('content')
  <div id="root" class="container_12">
    <div v-if="loading" class="loading-container">
      <div class="loading-animation"></div>
    </div>
    <div class="grid_12">
      <h2>APP de Prevención de abandono Animal</h2>
    </div>
    <div class="grid_12">
      <div class="custom-title">
        <div>Lista de Mascotas en adopción</div>
      </div>
    </div>
    <div class="clear"></div>
    <div v-cloak>
    <ul class="pets-grid" v-if="records.length > 0">
      <li class="pet-box" v-for="(item, index) in records"> 
          <div class="img-box">
            <img v-bind:src="appUrl +'/storage/app/'+item.ruta_imagen" alt="" class="img_inner">
          </div>          
          <div class="extra_wrapper pad1">
            <p class="col2"><a v-bind:href="appUrl+'/solicitar-mascota/'+item.id" >@{{ item.nombre | capitalize }}</a></p>
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
            `${localStorage.url}/api/mascotas`
          ).then(function (response) {
            this.records = response.data.data;
            this.loading = false;
          }, function (err) {
            catchErrors(err);
          });
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
      grid-template-columns: repeat(3, 1fr);
      column-gap: 8px;
    }

    .pet-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      border: 1px solid #efe6e6;
    }

    .img-box {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

  </style>
@endpush