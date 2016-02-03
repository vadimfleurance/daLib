<?php
namespace Controller;

use \W\Controller\Controller;

class SitemapController extends Controller
{
	public function sitemapWrite()
	{	
		$urls= [
				'links'=>[],
				'dates'=>[]
				];

		$movieManager = new \Manager\MovieManager;
		$movies = $movieManager->getAllDtbMovies();
		$homelastmod = filemtime( '../app/templates/default/home.php' );
		$homedate = date('Y-m-d', $homelastmod );
		//debug($date);
		//die();
		foreach  ($movies as $movie) {

			$urls['links'][] = "http://localhost/daLib/public/movie-detail/".$movie['id']."/";
			$urls['dates'][] = $movie['dateModified'];
			
		}
		
		$string = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
		$string .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
		$string .= "<url>"."<loc>"."\n".'http://localhost/daLib/public/'."\n"."</loc>"."\n";
		$string .= "<lastmod>".$homedate."</lastmod>"."\n"."</url>"."\n";

		foreach ($urls['links'] as $key =>$link){
			$string .='<url>'."\n";
				$string .= "<loc>".$link."</loc>"."\n";
				$string .= "<lastmod>".substr($urls['dates'][$key], 0 , 10)."</lastmod>"."\n";
				$string .= "<changefreq>monthly</changefreq>";
			$string .='</url>'."\n";
		}
		$string .= "</urlset>";
		
		//simule un fichier xml à partir de la string
		header("Content-type: application/xml");
		echo $string;

	}//end of method

}//end of class