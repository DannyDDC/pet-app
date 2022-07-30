@extends('plantilla')

@section('content')
  <div id="root" class="container_12">
    <div v-if="loading" class="loading-container">
      <div class="loading-animation"></div>
    </div>
    <div class="grid_8 prefix_1" v-cloak>
      <h2 class="ic1">Registrar Contacto</h2>
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
                v-model="params.identificacion" 
                placeholder="identificación"
              >
              <div v-if="custom_errors.length && !params.identificacion">
                <span class="custom-error">*Este campo es requerido</span>
              </div>  
            </div>

            <div class="form-group">        
              <input
                type="text"
                v-model="params.direccion" 
                placeholder="dirección"
              >
              <div v-if="custom_errors.length && !params.direccion">
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
                v-model="params.sitio_web" 
                placeholder="sitio web"
              >
              <div v-if="custom_errors.length && !params.sitio_web">
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
              <input
                type="text"
                v-model="params.requisitos_previos" 
                placeholder="requisitos previos"
              >
              <div v-if="custom_errors.length && !params.requisitos_previos">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group">        
              <select class="custom-select" v-model="params.tipo_animales" multiple>
                <option hidden  value="">Selecciona un tipo</option>
                <option v-bind:value="item.id" v-for="(item, index) in records">@{{item.id}}</option>                
              </select>
              <div v-if="custom_errors.length && !params.tipo_animales">
                <span class="custom-error">*Este campo es requerido</span>
              </div>  
            </div>
          </div>

          <div>
            <button type="submit" class="custom-btn">Registrar</button>               
          </div>
             
        </div>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
<script>  
    var app = new Vue({
      el: '#root',
      data: {
        loading: false,
        recordsOne: [],
        records: [],
        custom_errors: [],
        params: {
          nombre: undefined,
          identificacion: undefined,
          direccion: undefined,
          correo_electronico: undefined,
          telefono: undefined,
          ciudad: undefined,
          sitio_web: undefined,
          requisitos_previos: undefined,
          tipo_animales: []
        },
      },
      mounted() {                
        this.getTipoAnimales();
      },
      methods: {
        getTipoAnimales: function() {
          this.$http.get(
            `${localStorage.url}/api/tipo-animales`
          ).then(function (response) {
            this.records = response.data;
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
         console.log(this.params);
          this.$http.post(`${localStorage.url}/api/contactos`, this.params).then((res) => {
            this.loading = false;  
            window.location.href = `contactos`;             
          }, function (err) {
            catchErrors(err);
          });
        },
        validate: function() {
          this.custom_errors = [];

          if (!this.params.nombre) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.identificacion) {
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

          if (!this.params.sitio_web) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.tipo_animales.length) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.requisitos_previos) {
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
    .custom-select {
      height: 100% !important;
    }

  </style>
@endpush