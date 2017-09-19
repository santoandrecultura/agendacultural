<?php
/**
 * Template Name: Lista de Espaços
 * For listing events
 *
 * @package cultural
 */

?>

<?php 
//Verifica se a wp_mapasculturais existe
global $wpdb;
$resultado = $wpdb->get_results("SHOW TABLES LIKE 'wp_mapasculturais'");
if(count($resultado) == 0){
	
	// Gera uma tabela wp_mapasculturais
	$cria_tabela = "CREATE TABLE `wp_mapasculturais` (
  `id` int(11) NOT NULL, 
  `mapas_id` int(11) NOT NULL,
  `entidade` varchar(15) NOT NULL,
  `json` longtext NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$alter_tabela01 = "
	ALTER TABLE `wp_mapasculturais`
  ADD PRIMARY KEY (`id`);";
  $alter_tabela02 ="
  ALTER TABLE `wp_mapasculturais` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

";
	$wpdb->query($cria_tabela);
	$wpdb->query($alter_tabela01);
	$wpdb->query($alter_tabela02);
	// Fim da Geração de Tabelas
	
	// Importa Dados
	
	
	
	
	
}else{

}

function converterObjParaArray($data) { //função que transforma objeto vindo do json em array

    if (is_object($data)) {
        $data = get_object_vars($data);
    }

    if (is_array($data)) {
        return array_map(__FUNCTION__, $data);
    }
    else {
        return $data;
    }
}

//$url = "http://culturaz.santoandre.sp.gov.br/api/space/describe";

$res = $wpdb->get_results("SELECT option_value FROM wp_options WHERE option_name = 'mapasculturais-configuration'");

$opt = get_option('mapasculturais-configuration');




$url = $opt['URL']."/api/space/find";

$data = array(
   	//"@from" => "2017-09-01",
	//"@to" => "2017-09-30",
	"@select" => "id, name,endereco,singleUrl,shortDescription, telefonePublico,emailPublico,parent",
	"@seals" => "1,2,3",
	"@order" => "name ASC"
	//"owner" => "IN(870,105)",
	//"isVerified" => TRUE
	//"@order" => "id ASC"
	
	);

$get_addr = $url.'?'.http_build_query($data);
$ch = curl_init($get_addr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$page = curl_exec($ch);

$evento = json_decode($page);

$ccsp = converterObjParaArray($evento);


//var_dump($resultado);



// Pega o content e desmembra para pegar as diretrizes



?>



<?php get_header(); ?>

<div class="content  content--full" ng-controller="eventsController">
    <?php if(is_page() && get_the_content()): the_post();?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="hentry-wrap">
            <div class="entry-content">
            </div>
        </div>
    </article>
    <?php endif; ?>

<header class="page-header"><h1 class="page-title"><?php the_title(); ?></h1></header>


    
    <div class="events-list grid js-events-masonry" >

<?php 
for($i = 0; $i < count($ccsp); $i++){
	if($ccsp[$i]['endereco'] != "" AND $ccsp[$i]['parent'] == "" ){
	?>


        <div class="event espaco  event-container" >
            <div class="event-data">
                <h1 class="event__title">

                    <?php echo $ccsp[$i]['name']?>
                    <!--<a href="{{event.singleUrl}}" target="_blank"><i class="fa fa-external-link"></i></a>-->
                    
                </h1>
  
				<p><i><?php echo $ccsp[$i]['shortDescription']; ?></i></p>    
				<p><strong>Endereço:</strong> <?php echo $ccsp[$i]['endereco']; ?></p>  
				<p><strong>Telefone:</strong> <?php echo $ccsp[$i]['telefonePublico']; ?></p>    
				<p><strong>Email:</strong> <?php echo $ccsp[$i]['emailPublico']; ?></p>    

                <a href="<?php echo $ccsp[$i]['singleUrl']; ?>" target="_blank" class="event__info"><?php _e('Mais informações', 'cultural'); ?></a>
            </div>
        </div>
 
    
    <?php
	}
}
?>
 </div>
    <?php comments_template('', true); ?>
</div>

<?php
get_footer();
