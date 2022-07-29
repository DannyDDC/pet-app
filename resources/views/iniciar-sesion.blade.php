@extends('plantilla')

@section('content')
  <div id="root" class="container_12">
    <div v-if="loading" class="loading-container">
      <div class="loading-animation"></div>
    </div>
    <div class="grid_8 prefix_1" v-cloak>
      <h2 class="ic1">Iniciar sesión</h2>
      <form id="form" @submit.prevent="submit($event)">      
        <div class="custom-form">
          <div> 
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
                type="password"
                v-model="params.password" 
                placeholder="contraseña"
              >
              <div v-if="custom_errors.length && !params.password">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>
          </div>

          <div>            
            <button type="submit" class="btn">Iniciar sesión</button>            
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
          password: undefined,
          email: undefined        
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
         
          this.$http.post(`${localStorage.url}/api/auth/token`, this.params).then((res) => {
            appState(res.data);               
            this.loading = false;    
            window.location.href = `inicio`;        
          }, function (err) {
            catchErrors(err);
          });
        },
        validate: function() {
          this.custom_errors = [];

          if (!this.params.password) {
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