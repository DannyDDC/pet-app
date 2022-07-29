@extends('plantilla')

@section('content')
  <div id="root" class="container_12">
    <div v-if="loading" class="loading-container">
      <div class="loading-animation"></div>
    </div>
   
    <div class="grid_7" v-cloak>
      <h2 class="ic1">Solicitar mascota</h2>
      <form id="form" @submit.prevent="submit($event)">
        <div class="custom-form">
          <div> 
            <div class="form-group">        
              <input
                type="text"
                v-model="params.nombre" 
                placeholder="nombre"
              >
              <div v-if="custom_errors.length && !params.nombre">
                <span class="custom-error">*Este campo es requerido</span>
              </div>  
            </div>

            <div class="form-group"> 
              <input
                type="text"
                v-model="params.correo_electronico" 
                placeholder="correo electrónico"
              >
              <div v-if="custom_errors.length && !params.correo_electronico">
                <span class="custom-error">*Este campo es requerido</span>
              </div> 
              <div v-if="custom_errors.length && custom_errors.includes('invalido')">
                <span class="custom-error">*Este campo debe ser un email válido</span>
              </div> 
            </div>      

            <div class="form-group"> 
              <input
                type="text"
                v-model="params.telefono" 
                placeholder="número de teléfono"
              >
              <div v-if="custom_errors.length && !params.telefono">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group"> 
              <input
                type="text"
                v-model="params.direccion" 
                placeholder="dirección"
              >
              <div v-if="custom_errors.length && !params.direccion">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group"> 
              <input
                type="text"
                v-model="params.ciudad" 
                placeholder="ciudad"
              >
              <div v-if="custom_errors.length && !params.ciudad">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

          <div class="form-group"> 
              <textarea
              rows="3"
                v-model="params.motivo" 
                placeholder="motivo"
              ></textarea>
              <div v-if="custom_errors.length && !params.motivo">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>
          </div>

          <div>
            <button type="submit" class="btn">Enviar</button>               
          </div>
             
        </div>
      </form>     
    </div>
    <div v-if="record" class="grid_5" v-cloak>   
      <div class="pet-box">   
        <div class="img-box">
          <img v-bind:src="appUrl +'/storage/app/'+record.ruta_imagen" alt="" class="img_inner">
        </div>    
        <div>
         <b>@{{record.nombre | capitalize}}</b> / edad: @{{record.anios }} años, @{{record.meses}} meses, 
         altura: @{{record.altura}} cm, peso: @{{record.peso}} kg, vacunado: @{{record.vacunado ? 'si' : 'no'}}
        </div>  
      </div>
    </div>
    
  </div> 
@endsection

@section('scripts')
<script>  
    var app = new Vue({
      el: '#root',
      data: {
        loading: true,
        record: undefined,
        custom_errors: [],
        params: {
          nombre: undefined,
          correo_electronico: undefined,
          telefono: undefined,
          direccion: undefined,
          ciudad: undefined,
          motivo: undefined,
          animal_id: undefined
        },
        pet_id: undefined,
        appUrl: null
      },
      mounted() {      
        const pathname = window.location.pathname;     
        this.pet_id = pathname.split('/')[3];  
        this.appUrl = localStorage.url;   
        this.loadData(this.pet_id);        
      },
      methods: {
        loadData: function(id) {
          this.$http.get(
            `${localStorage.url}/api/mascotas/${id}`
          ).then(function (response) {
            this.record = response.data;
            this.loading = false;
          }, function (err) {
            catchErrors(err);
          });
        },
        submit: function(form) {          
          if (this.validate()) {            
            return;
          }
          this.loading = true;
          this.params.animal_id = this.pet_id;
          this.$http.post(`${localStorage.url}/api/solicitudes`, this.params).then((res) => {
            this.loading = false;  
            window.location.href = `../inicio`;          
          }, function (err) {
            catchErrors(err);
          });
        },
        validate: function() {
          this.custom_errors = [];

          if (!this.params.nombre) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.direccion) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.telefono) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.ciudad) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.motivo) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.correo_electronico) {
            this.custom_errors.push('El correo electrónico es obligatorio.');
          } else if (!this.validEmail(this.params.correo_electronico)) {
            this.custom_errors.push('invalido');
          }

          if (this.custom_errors.length) {
            return true;
          }

          return false;
        },
        validEmail: function (email) {
          var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return re.test(email);
        }
      }
    });
</script>
@stop


@push('css-styles')
  <style type="text/css">  
    .pet-box {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 100px;
    }

    .img-box {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

  </style>
@endpush