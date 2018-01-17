@extends('layouts.app')

@section('content')
<div class="preload">
    <div class="preload-title">
        <span class="preload-titleOne">Truis <span class="preload-titleTwo">Taartjes</span></span>
    </div>

    <div class="loader-frame">
        <div class="loader1" id="loader1"></div>
        <div class="loader2" id="loader2"></div>
    </div>
</div>

    <div class="container main-container">

    <div class="scroll-pagenav-left">
      <ul class="pagenav-ul">
            <li class="pagenav-il-one"><a href="#cake-top" class="pagenav-a-one">Top</a></li>
            <li class="pagenav-il-two"><a href="#cake-quote" class="pagenav-a-two">Quote</a></li>
      </ul>
    </div>
    <div class="scroll-pagenav-right">
      <ul class="pagenav-ul">
        <li class="pagenav-il-three"><a href="#cake-preview" class="pagenav-a-three">Werkjes</a></li>
        <li class="pagenav-il-four"><a href="#cake-completed" class="pagenav-a-four">Compleet</a></li>
      </ul>
    </div>


        <section id="cake-top" class="section section-top">
                <div class="container section-container top-container">

    <div id="full-carousel" class="ken-burns carousel slide full-carousel carousel-fade" data-ride="carousel" data-interval="10000">
            <ol class="carousel-indicators">
                <li data-target="#full-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#full-carousel" data-slide-to="1"></li>
                <li data-target="#full-carousel" data-slide-to="2"></li>
                <li data-target="#full-carousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active inactiveUntilOnLoad">
                    <div class="carousel-image1" style="background-image: url(/uploads/frontslider/{{$allSliders[0]->imageName}}); background-size: cover; background-position: center;"></div>
                    <!-- <div class="carousel-image1"></div> -->

                    <div class="container">
                        <div class="carousel-caption">
                            <h1>{{$allSliders[0]->sliderTitle}}</h1>

                                <p>
                                    {{$allSliders[0]->sliderCaption}}
                                </p>
                                
                        </div>      
                    </div>
                </div>
                
                <div class="item">
                    <div class="carousel-image2" style="background-image: url(/uploads/frontslider/{{$allSliders[1]->imageName}}); background-size: cover; background-position: center;"> 
                    </div>
                    <!-- <div class="carousel-image2"></div> -->

                    <div class="container">
                        <div class="carousel-caption">
                            <h1>{{$allSliders[1]->sliderTitle}}</h1>
                            
                                <p>
                                    {{$allSliders[1]->sliderCaption}}
                                </p>

                        </div>
                    </div>
                </div>
                
                <div class="item">
                    <div class="carousel-image3" style="background-image: url(/uploads/frontslider/{{$allSliders[2]->imageName}}); background-size: cover; background-position: center;">
                    </div>
                    <!-- <div class="carousel-image3"></div> -->

                    <div class="container">
                        <div class="carousel-caption">
                            <h1>{{$allSliders[2]->sliderTitle}}</h1>

                            <p>
                               {{$allSliders[2]->sliderCaption}}
                            </p>
                            
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="carousel-image4" style="background-image: url(/uploads/frontslider/{{$allSliders[3]->imageName}}); background-size: cover; background-position: center;">
                    </div>
                    <!-- <div class="carousel-image4"></div> -->

                    <div class="container">
                        <div class="carousel-caption">
                            <h1>{{$allSliders[3]->sliderTitle}}</h1>
                            
                                <p>
                                    {{$allSliders[3]->sliderCaption}}
                                </p>

                        </div>
                    </div>
                </div>
                            
            </div>
        </div>


                </div>
        </section>


        <section id="cake-quote" class="section section-quote">
            <div class="container section-container quote-container">

                <div class="quote-photo-container">
                    <div class="quote-photo" style="background: url(/uploads/frontpage/{{$frontQuote->imageName}});
                                                   background-size: cover;
                                                   background-position: center;
                                                   background-repeat: no-repeat;">
                        
                    </div>
                </div>

                <div class="quote-text">

                    <div class="quote-left-div">
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                    </div>
                    <div class="quote-p">
                        {{$frontQuote->quote}}
                    </div>
                    <div class="quote-right-div">
                        <i class="fa fa-quote-right" aria-hidden="true"></i>
                    </div>

                </div>
            </div>
        </section>

        <section id="cake-preview" class="section section-voorbeelden">
        <div class="container section-container isotope-container">
        <h4 class="sectionHeader4">Werkjes</h4>
            
                <div class="row isotope-button-row section-row">
                    <div class="button-group filter-button-group">
                      <button class="isobtn" data-filter="*">Alles</button>
                      <button class="isobtn" data-filter=".Taart">Taart</button>
                      <button class="isobtn" data-filter=".Decoratie">Decoraties</button>
                    </div>
                </div>

                <div class="row isotope-row section-row">

                <div class="isotope iso-cake-grid">

                     <div class="grid">
                            @foreach($allIstopeimages as $isotopeImage)
                                @if($isotopeImage->isoTypeTwo == NULL)
                                <div class="element-item iso-grid-item {{$isotopeImage->getIsoTypeOne()}}">
                                    <div class="preview-item">
                                        <div class="preview-gridimage">
                                        <img src="/uploads/isotopes/{{$isotopeImage->imageName}}">
                                        </div>
                                    </div>
                                 </div>
                                 @else
                                <div class="element-item iso-grid-item {{$isotopeImage->getIsoTypeOne()}} {{$isotopeImage->getIsoTypeTwo()}}">
                                    <div class="preview-item">
                                        <div class="preview-gridimage">
                                        <img src="/uploads/isotopes/{{$isotopeImage->imageName}}">
                                        </div>
                                    </div>
                                 </div>
                                 @endif
                            @endforeach

                     </div> <!-- /GRID -->

                </div>

                </div>
            </div>
        </section>

        <section id="cake-completed" class="section section-completed">
            <div class="container section-container completed-container">
            <div class="row completed-title-row">
                <h4 class="sectionHeader4">Gemaakt</h4>
            </div>
                <div class="row completed-row">
                    <div class="col-xs-12 col-sm-4 col-md-4 completed-procent">
                        <div id="cakeProcent"></div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 completed-procent">
                        <div id="decoratieProcent"></div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 completed-procent">
                        <div id="creatieProcent"></div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script type="text/javascript" src="/js/custom/preloader.js"></script>
    <script>
        $(function() {

$cakeCount = {!! $countTaarten !!};
$decorCount = {!! $countDecoraties !!};
$anderCount = {!! $countAnders !!};

//alert($cakeCount);

var cakeBar = new ProgressBar.SemiCircle(cakeProcent, {
  strokeWidth: 6,
  color: '#56a0d3',
  trailColor: '#eee',
  trailWidth: 1,
  easing: 'easeInOut',
  duration: 3000,
  svgStyle: null,
  text: {
    value: '',
    alignToBottom: false
  },
  from: {color: '#56a0d3'},
  to: {color: '#00ff9f'},
  // Set default step function for all animate calls
  step: (state, cakeBar) => {
    cakeBar.path.setAttribute('stroke', state.color);
    var value = Math.round(cakeBar.value() * $cakeCount);
    if (value === 0) {
      cakeBar.setText('Taarten <br>0');
    } else {
      cakeBar.setText('Taarten <br>'+value);
    }

    cakeBar.text.style.color = state.color;
  }
});
cakeBar.text.style.fontFamily = '"Kavoon", Helvetica, sans-serif';
cakeBar.text.style.fontSize = '3rem';
cakeBar.text.style.top = '0%';
cakeBar.text.style.textAlign = 'center';

//cakeBar.animate(1.0);  // Number from 0.0 to 1.0
////////////////////////////////////////////////////////////
var decoratieBar = new ProgressBar.SemiCircle(decoratieProcent, {
  strokeWidth: 6,
  color: '#56a0d3',
  trailColor: '#eee',
  trailWidth: 1,
  easing: 'easeInOut',
  duration: 3000,
  svgStyle: null,
  text: {
    value: '',
    alignToBottom: false
  },
  from: {color: '#56a0d3'},
  to: {color: '#00ff9f'},
  // Set default step function for all animate calls
  step: (state, decoratieBar) => {
    decoratieBar.path.setAttribute('stroke', state.color);
    var value = Math.round(decoratieBar.value() * $decorCount);
    if (value === 0) {
      decoratieBar.setText('Decoraties <br>0');
    } else {
      decoratieBar.setText('Decoraties <br>'+value);
    }

    decoratieBar.text.style.color = state.color;
  }
});
decoratieBar.text.style.fontFamily = '"Kavoon", Helvetica, sans-serif';
decoratieBar.text.style.fontSize = '3rem';
decoratieBar.text.style.top = '0%';
decoratieBar.text.style.textAlign = 'center';

//decoratieBar.animate(1.0);  // Number from 0.0 to 1.0
//////////////////////////////////////////////////////////////
var creatieBar = new ProgressBar.SemiCircle(creatieProcent, {
  strokeWidth: 6,
  color: '#56a0d3',
  trailColor: '#eee',
  trailWidth: 1,
  easing: 'easeInOut',
  duration: 3000,
  svgStyle: null,
  text: {
    value: '',
    alignToBottom: false
  },
  from: {color: '#56a0d3'},
  to: {color: '#00ff9f'},
  // Set default step function for all animate calls
  step: (state, creatieBar) => {
    creatieBar.path.setAttribute('stroke', state.color);
    var value = Math.round(creatieBar.value() * $anderCount);
    if (value === 0) {
      creatieBar.setText('Creaties <br>0');
    } else {
      creatieBar.setText('Creaties <br>'+value);
    }

    creatieBar.text.style.color = state.color;
  }
});
creatieBar.text.style.fontFamily = '"Kavoon", Helvetica, sans-serif';
creatieBar.text.style.fontSize = '3rem';
creatieBar.text.style.top = '0%';
creatieBar.text.style.textAlign = 'center';

//creatieBar.animate(1.0);  // Number from 0.0 to 1.0

$(window).scroll(function() {
   var hT = $('.grid').offset().top,
       hH = $('.grid').outerHeight(),
       wH = $(window).height(),
       wHH = $(window).height()+250,
       wS = $(this).scrollTop();
    //console.log((hT-wH) , wS);
   if (wS > (hT+hH-wH)){
    ///console.log('reach');
    cakeBar.animate(1.0);
    decoratieBar.animate(1.0);
    creatieBar.animate(1.0);
    //$(window).off('scroll');
   }
});


        });
    </script>
@endsection
