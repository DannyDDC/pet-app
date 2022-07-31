<!DOCTYPE html>
<html lang="en">
<head>
<title>Donanimal</title>
<meta charset="utf-8">
<link rel="icon" href="{{ asset('public/assets/dist/images/favicon.ico') }}">
<link rel="shortcut icon" href="{{ asset('public/assets/dist/images/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('public/assets/dist/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/dist/css/slider.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/dist/css/form.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/dist/css/helpers.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vue/vue-select.css') }}">

<script src="{{ asset('public/assets/vue/vue.js') }}"></script>
<script src="{{ asset('public/assets/vue/vue-resource.min.js') }}"></script>
<script src="{{ asset('public/assets/vue/vue-select.js') }}"></script>
<script src="{{ asset('public/assets/vue/vue-pagination.js') }}"></script>
<script src="{{ asset('public/assets/vue/vee-validate.js') }}"></script>
<script src="{{ asset('public/assets/dist/js/helpers.js') }}"></script>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<link rel="stylesheet" media="screen" href="css/ie.css">
<![endif]-->
@stack('css-styles')
</head>
<body>
  <div id="app" class="page1 app-container">
    <header>
        <div id="superroot" class="container_12">
            <div class="grid_12">
                <div class="grid-container-custom">
                    <div class="item-box">      
                        <a href="{{ url('/inicio') }}">
                        <span class="app-name">DONANIMAL<span>
                        </a>              
                    </div>
                    <div class="menu_block">
                        <nav>
                            <ul class="sf-menu">
                                <li><a href="{{ url('/inicio') }}">Mascotas en adopción</a></li>           
                                <li><a href="{{ url('/registrar-mascota') }}">Deseo regalar mi mascota</a></li>
                                <li><a href="{{ url('/contactos') }}">Lista de contactos</a></li>
                            </ul>
                        </nav>
                        <div class="clear"></div>
                    </div>
                    <div class="item-box user-nick">
                        <span v-cloak>@{{ getNick(userPref.email) }}</span>
                    </div>
                    <div class="item-box">
                        <nav>
                            <ul class="sf-menu">
                                <li class="with_ul">                                    
                                    <img src="{{ asset('public/assets/dist/images/user.png') }}" alt="">
                                    <ul>
                                        <li><a href="{{ url('/ingresar') }}">Ingresar</a></li>
                                        <li><a href="#" onclick="logout()">Salir</a></li>
                                    </ul>
                                </li>                                          
                            </ul>
                        </nav>
                    </div>
                </div>   
                <div class="clear"></div>
            </div>
        </div>
    </header>

    <div class="custom-content">
        @yield('content')
    </div>  
    
    <script src="{{ asset('public/assets/dist/js/jquery.js') }}"></script>
    <script src="{{ asset('public/assets/dist/js/jquery-migrate-1.1.1.js') }}"></script>
    <script src="{{ asset('public/assets/dist/js/superfish.js') }}"></script>
    <script src="{{ asset('public/assets/dist/js/jquery.carouFredSel-6.1.0-packed.js') }}"></script>
    <script src="{{ asset('public/assets/dist/js/jquery.equalheights.js') }}"></script>
    <script src="{{ asset('public/assets/dist/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('public/assets/dist/js/tms-0.4.1.js') }}"></script>
    <script src="{{ asset('public/assets/dist/js/jquery.ui.totop.js') }}"></script>
    <script>
        activeMenuItem();
        setAppUrl();
        Vue.config.productionTip = false;
			// Vue.http.headers.common['Authorization']=`Bearer ${localStorage.token}`;
			Vue.http.interceptors.push(function(request, next) {
				request.headers.set('Authorization', `Bearer ${localStorage.token}`);
				request.headers.set('Content-Type', 'application/json');

				next(function(response){
					if (response.status === 401) {
						return Vue.http.get(`${api_url}/auth/refresh`).then(function (res) {
							localStorage.token = res.data.access_token;
							request.headers.set('Authorization', `Bearer ${res.data.access_token}`);
							return Vue.http(request).then(data => {
								return data;
							});
						}, () => logout());
					}
				})
			});
        	Vue.filter('capitalize', function(value) {
				const capitalized = value.charAt(0).toUpperCase() + value.slice(1);
                return capitalized;
			});            

            var appIn = new Vue({
				el: '#superroot',
				data: {
					userPref: {},
					permissions: []
				},
				mounted() {
					this.userPref = JSON.parse(localStorage.current_user || "{}");
				},
				methods: {
                    getNick: function(email) {
                        if(!email) return;
                        const pos = email.search('@');
                        const nick = email.substring(0, pos);
						return nick;
					},
				}
			})

            $(window).load(function () {
                $('.slider')._TMS({
                    show: 0,
                    pauseOnHover: false,
                    prevBu: '.prev',
                    nextBu: '.next',
                    playBu: false,
                    duration: 800,
                    preset: 'fade',
                    pagination: true, //'.pagination',true,'<ul></ul>'
                    pagNums: false,
                    slideshow: 8000,
                    numStatus: false,
                    banners: true,
                    waitBannerAnimation: false,
                    progressBar: false
                })
            });
            $(window).load(function () {
                $('.carousel1').carouFredSel({
                    auto: false,
                    prev: '.prev',
                    next: '.next',
                    width: 960,
                    items: {
                        visible: {
                            min: 3,
                            max: 3
                        },
                        height: 'auto',
                        width: 300,
                    },
                    responsive: true,
                    scroll: 1,
                    mousewheel: false,
                    swipe: {
                        onMouse: true,
                        onTouch: true
                    }
                });
            });            
        jQuery(document).ready(function () {
            $().UItoTop({
                easingType: 'easeOutQuart'
            });
        });
    </script>
    @yield('scripts')
  </div>  
  </body>  
</html>
