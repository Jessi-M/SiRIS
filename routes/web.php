<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * rutas utilizadas 
 */
 
Route::get('/', function () {
	   
    return view('admin.main');
});

Route::get('view', 'readHtml@start');

Route::get('nombre', function(){
   
 //$feed = Feeds::make('https://www.prensa.com/rss.html');
//$feed = FeedReader::read('http://elnacional.com.do/feed/');
   
  // foreach($feed->get_items() as $item){
    //  (print_r($item->get_description().'<br>')); // RESUMEN DE LA NOTICIA 
     //print_r($item->get_title().'<br>'); //titulo de la noticia 
     // print_r($item->get_link().'<br><br><br><br>'); // LOS LINKS 

 //  }
$html = new \Htmldom('http://www.el-nacional.com/sucesos/');
//vector con las posibles ubicacions de los sucesos
$ubicacion= array ("altagracia","antímano","caricuao","catedral","Coche","junquito",
  "paraiso","recreo","valle","candelaria","pastora","vega","macarao","catia",
  "sanagustín","sanbernardino","sanjose","sanjuan","sanpedro","santarosalia",
  "santateresa","23deenero");
// muestra todo los parrafos 
///foreach($html->find('article') as $element) 

//extrayendo los links de sucesos 
    foreach($html->find('a') as $element) {
   //compara si el substring existe en el link        
        //$findme   = 'http://www.ultimasnoticias.com.ve/seccion/sucesos/';
          $pos = strpos($element-> href, 'http://www.el-nacional.com/noticias/sucesos/');
     
          if($pos!==false){
             //busca la ubicacion del suceso
             $i=0;
             $encuentra_ubic=true;
             while($encuentra_ubic && $i<sizeof($ubicacion)){
              
                if(strpos($element->href, $ubicacion[$i]) !== false){
                  //se guarda el link y el doc en la BD
                  $encuentra_ubic=false;
                  $html2 = new \Htmldom($element->href);
                  echo 'LINK REVISANDO --> '.$element->href;
                  //extrauyendo la fecha de la noticia
                  $ret = $html2->find('time[class=date]'); 
                  $fecha_notic=$ret[0]->attr['datetime'];
                  //extrayendo el tiutulo de la noticia
                  $tittle_notice=$html2->find('h1[class=tittle]'); 
                  $articulo='';
                  //extrayendo el parrafo del link de la noticia
                  foreach($html2->find('p[style]') as $element2){
                      //concatenando los parrafos del html
                      $articulo=$articulo.$element2;
                      
                  }
                  $articulo_normalizado=strip_tags(html_entity_decode($articulo, ENT_HTML5, 'UTF-8'));
                  
                  //echo $articulo;
                  //dd($articulo);
                  //llamar a func limpiar palabra con $articulo
                 
               }
              $i++;
          }
       }
    } 


}); 


Route::resource('readHtmls', 'readHtmlController');