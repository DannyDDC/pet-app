@extends('plantilla')

@section('content')
  <div id="root" class="container_12">
    <div v-if="loading" class="loading-container">
      <div class="loading-animation"></div>
    </div>
    <div class="grid_8 prefix_1" v-cloak>
      <h2 class="ic1">Registrarse</h2>
      <form id="form" @submit.prevent="submit($event)">
        <div class="success_wrapper">
          <div class="success">Contact form submitted!</div>
        </div>
        <div class="custom-form">
          <div> 
            <div class="form-group">        
              <input
                type="text"
                v-model="params.name" 
                placeholder="nombre"
              >
              <div v-if="custom_errors.length && !params.name">
                <span class="custom-error">*Este campo es requerido</span>
              </div>  
            </div>

            <div class="form-group"> 
              <input
                type="text"
                v-model="params.email" 
                placeholder="correo electrónico"
              >
              <div v-if="custom_errors.length && !params.email">
                <span class="custom-error">*Este campo es requerido</span>
              </div> 
              <div v-if="custom_errors.length && custom_errors.includes('invalido')">
                <span class="custom-error">*Este campo debe ser un email válido</span>
              </div> 
            </div>      

            <div class="form-group"> 
              <input
                type="text"
                v-model="params.phone_number" 
                placeholder="número de teléfono"
              >
              <div v-if="custom_errors.length && !params.phone_number">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group"> 
              <input
                type="text"
                v-model="params.address" 
                placeholder="dirección"
              >
              <div v-if="custom_errors.length && !params.address">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group"> 
              <input
                type="text"
                v-model="params.city" 
                placeholder="ciudad"
              >
              <div v-if="custom_errors.length && !params.city">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>
          </div>

          <div>
            <button class="custom-btn" type="submit" class="btn">Registrar</button>               
          </div>
             
        </div>
      </form>
      <br/>
      <a href="{{ url('/ingresar') }}">Inicia sesión si ya eres un usuario registrado >></a>
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
          name: undefined,
          email: undefined,
          phone_number: undefined,
          address: undefined,
          city: undefined,
          roles: ['DONANTE']
        },
      },
      mounted() {                
        
      },
      methods: {
        submit: function(form) {          
          if (this.validate()) {            
            return;
          }
          this.loading = true;
         
          this.$http.post(`${localStorage.url}/api/users`, this.params).then((res) => {
            this.params = Object.assign({}, {
              name: undefined,
              email: undefined,
              phone_number: undefined,
              address: undefined,
              city: undefined,
              roles: ['DONANTE']
            });      
            this.loading = false;  
            window.location.href = `ingresar`;             
          }, function (err) {
            catchErrors(err);
          });
        },
        validate: function() {
          this.custom_errors = [];

          if (!this.params.name) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.address) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.phone_number) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.city) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.email) {
            this.custom_errors.push('El correo electrónico es obligatorio.');
          } else if (!this.validEmail(this.params.email)) {
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
    .custom-title {
      font-size: 20px;
      padding-bottom: 20px;
    }

  </style>
@endpush