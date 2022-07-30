@extends('plantilla')

@section('content')
  <div id="root" class="container_12">
    <div v-if="loading" class="loading-container">
      <div class="loading-animation"></div>
    </div>
    <div class="grid_8 prefix_1"  v-cloak>
      <h2 class="ic1">Registrar Mascota</h2>
      <form id="form" @submit.prevent="submit($event)">
        <div class="custom-form">
          <div> 
            <div class="form-group">        
              <select v-model="params.tipo_animal_id">
                <option hidden  value="">Selecciona un tipo</option>
                <option v-bind:value="item.id" v-for="(item, index) in records">@{{item.id}}</option>                
              </select>
              <div v-if="custom_errors.length && !params.tipo_animal_id">
                <span class="custom-error">*Este campo es requerido</span>
              </div>  
            </div>

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
                type="number"
                v-model="params.anios" 
                placeholder="años"
              >
              <div v-if="custom_errors.length && !params.anios">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group"> 
              <input
                type="number"
                v-model="params.meses" 
                placeholder="meses"
              >
              <div v-if="custom_errors.length && !params.meses">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group"> 
              <input
                type="number"
                v-model="params.altura" 
                placeholder="altura (cm)"
              >
              <div v-if="custom_errors.length && !params.altura">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group"> 
              <input
                type="number"
                v-model="params.peso" 
                placeholder="peso (kg)"
              >
              <div v-if="custom_errors.length && !params.peso">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group"> 
              <input
                type="text"
                v-model="params.color" 
                placeholder="color"
              >
              <div v-if="custom_errors.length && !params.color">
                <span class="custom-error">*Este campo es requerido.</span>
              </div> 
            </div>

            <div class="form-group"> 
            <label class="custom-file-label" for="exampleInputFile">Imagen</label>
              <input 
                type="file" 
                class="custom-file-input"
                accept="image/png,image/jpeg"
                @change="onFileSelected"
                placeholder="imagen"
              >
                  
                  <div v-if="custom_errors.length && !image" class="invalid-feedback">
                    <div>solicitud es requerido</div>
                  </div>
                  <div v-if="custom_errors.includes('exceeded')" class="invalid-feedback">
                    <div>tamaño excedido</div>
                  </div>
              </div>

              <div class="form-group"> 
              
              <label>
              Vacunado?
              <input
                type="checkbox"
                v-model="params.vacunado" 
              >
              </label>              
              
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
        loading: true,
        recordsOne: [],
        records: [],
        custom_errors: [],
        params: {
          nombre: undefined,
          tipo_animal_id: "",
          anios: undefined,
          meses: undefined,
          peso: undefined,
          color: undefined,
          user_id: undefined,
          vacunado: false
        },
        image: undefined,
        currentUser: {}
      },
      mounted() {        
        this.currentUser = JSON.parse(localStorage.current_user || "{}");        
        this.checkSession();        
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
        checkSession: function() {          
          if (!localStorage.token) {
            window.location.href = `registrar`;
          }
          this.getTipoAnimales();
        },
        submit: function(form) {          
          if (this.validate()) {            
            return;
          }
          this.loading = true;
         
          const formData = new FormData();
          formData.append('petImg', this.image);
          formData.append('nombre', this.params.nombre);
          formData.append('tipo_animal_id', this.params.tipo_animal_id);
          formData.append('descripcion', "mascota"); 
          formData.append('anios', this.params.anios); 
          formData.append('meses', this.params.meses); 
          formData.append('altura', this.params.altura); 
          formData.append('peso', this.params.peso); 
          formData.append('color', this.params.color); 
          formData.append('vacunado', this.params.vacunado ? 1 : 0);           
          formData.append('user_id', this.currentUser.id);  

          this.$http.post(`${localStorage.url}/api/mascotas`, formData,{ headers: { 'Content-Type': 'multipart/form-data'}}).then((res) => {
            this.params = Object.assign({}, {
              nombre: undefined,
              tipo_animal_id: "",
              anios: undefined,
              meses: undefined,
              peso: undefined,
              color: undefined,
              user_id: undefined,
              vacunado: false
            });      
            this.loading = false;    
            window.location.href = `inicio`;    
          }, function (err) {
            catchErrors(err);
          });
        },
        onFileSelected: function(eve) {
          this.image = event.target.files[0];
        },
        validate: function() {
          this.custom_errors = [];

          if (!!this.image && (this.image.size > allowed_file_size)) {
            this.image = undefined;
            this.custom_errors.push('exceeded');
            return true;
          }

          if (!this.params.nombre) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.tipo_animal_id) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.anios) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.meses) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.altura) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.peso) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (!this.params.color) {
            this.custom_errors.push("El nombre es obligatorio.");
          }

          if (this.custom_errors.length) {
            return true;
          }

          return false;
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