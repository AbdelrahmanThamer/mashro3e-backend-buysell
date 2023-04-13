<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sitemap Controller
 */

class Sitemap_generators extends BE_Controller {
		/**
	 * Construt required variables
	 */
	function __construct() {

		parent::__construct( MODULE_CONTROL, 'Sitemap_Generators' );
		
		///start allow module check 
		$conds_mod['module_name'] = $this->router->fetch_class();
		
		$module_id = $this->Module->get_one_by($conds_mod)->module_id;
		
		$logged_in_user = $this->ps_auth->get_user_info();

		$user_id = $logged_in_user->user_id;
		if(empty($this->User->has_permission( $module_id,$user_id )) && $logged_in_user->user_is_sys_admin!=1){
			return redirect( site_url('/admin/') );
		}
		///end check
	}

	/**
	 * Load About Entry Form
	 */

	function index( ) {

		if ( $this->is_POST()) {
		// if the method is post

			// save sitemap xml file
			$this->createSitemap();
			
			// save sitemap zip file
			$sitemap_path = $this->createArchive();
			
			$data = $this->Sitemap_generator->get_last_row();
			
			if(!empty($sitemap_path) == TRUE){
				$this->set_flash_msg( 'success', get_msg( 'success_generate_sitemap' ));
				$sitemap_data['sitemap_path'] = $sitemap_path;
				
				$this->Sitemap_generator->save($sitemap_data);

			}else{
				$this->set_flash_msg( 'error', get_msg( 'err_generate_sitemap' ));
			}
		}

		$this->data['sitemap'] = $this->Sitemap_generator->get_last_row();
		$this->data['domain_name'] = $this->get_domain();

		$this->load_form($this->data);

	}

	/**
	 * generate sitemap files
	 */
	function createSitemap(){
		
		$domain_name = $this->get_domain();

		// sitemap directory path 
		$domain_sitemap = $domain_name . 'sitemaps/';

		// backend directory path
		$filepath = "uploads/";

		// get main sitemap file
		if (!is_dir($filepath)) {
			mkdir($filepath, 0777, TRUE);
		}

		$filename = $filepath . "sitemap.xml";
		if(file_exists($filename)){
			unlink($filename);
		}
		
		$today = date('Y-m-d\Th:m:s\.000\Z');

		// main sitemap context 
		$txt = 
	'<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<sitemap>
		<loc>' . $domain_sitemap . 'categories.xml</loc>
		<lastmod>' . $today . '</lastmod>
	</sitemap>
	<sitemap>
		<loc>' . $domain_sitemap . 'sub-categories.xml</loc>
		<lastmod>' . $today . '</lastmod>
	</sitemap>
	<sitemap>
		<loc>' . $domain_sitemap . 'products.xml</loc>
		<lastmod>' . $today . '</lastmod>
	</sitemap>
	<sitemap>
		<loc>' . $domain_sitemap . 'abouts.xml</loc>
		<lastmod>' . $today . '</lastmod>
	</sitemap>
</sitemapindex>
	';

		$file = fopen($filename, "w");
		fwrite($file, $txt);
		fclose($file);

		// get product sitemap file
		$data = $this->Category->get_all();
		$upload_path = "uploads/sitemaps/";
		$filename = $upload_path . "products.xml";
		$this->create_sitemap_index($data, $domain_name, $filename, $upload_path, $flag = "product");

		// get abouts sitemap file
		$domain_sitemap = $domain_name;
		$upload_path = "uploads/sitemaps/";
		$filename = $upload_path . "abouts.xml";
		$this->create_sitemap($data = false, $domain_sitemap, $filename, $upload_path, $flag = "about");

		// get categories sitemap file
		$data = $this->Category->get_all();
		$domain_sitemap = $domain_name;
		$upload_path = "uploads/sitemaps/";
		$filename = $upload_path . "categories.xml";
		$this->create_sitemap($data, $domain_sitemap, $filename, $upload_path, $flag = "cat");

		// get subcategories sitemap file
		$data = $this->Subcategory->get_all();
		$domain_sitemap = $domain_name;
		$upload_path = "uploads/sitemaps/";
		$filename = $upload_path . "sub-categories.xml";
		$this->create_sitemap($data, $domain_sitemap, $filename, $upload_path, $flag = "subcat");

		// get product cat sitemap file
		$cats = $this->Category->get_all();
		foreach($cats->result() as $cat){
			$domain_sitemap = $domain_name . 'item/';
			$upload_path = "uploads/sitemaps/products/";
			$filename = $upload_path . strtolower($cat->cat_name) . ".xml";
			$conds['cat_id'] = $cat->cat_id;
			$data = $this->Item->get_all_by($conds);
			$this->create_sitemap($data, $domain_sitemap, $filename, $upload_path, $flag = "product");
		}
		
	}

	// create sitemap index file
	function create_sitemap_index($data = false, $domain, $filename, $upload_path, $flag){
		$txt = ""; $file = "";
		if(file_exists($filename)){
			unlink($filename);
		}

		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0777, TRUE);
		}
		
		$today = date('Y-m-d\Th:m:s\.000\Z');
		
		$txt = '<?xml version="1.0" encoding="utf-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		';
		
		if($flag == "product"){
			foreach($data->result() as $item){
			$txt .= '<sitemap>
		<loc>' . $domain . 'sitemaps/products/'.strtolower($item->cat_name).'.xml' . '</loc>
		<lastmod>' . $today . '</lastmod>
	</sitemap>
	';
			}
		}

		$txt .= "</sitemapindex>";

		$file = fopen($filename, "w");
		fwrite($file, $txt);
		fclose($file);

	}

	// create sitemap urlset file
	function create_sitemap($data = false, $domain, $filename, $upload_path, $flag){
		$txt = ""; $file = "";
		if(file_exists($filename)){
			unlink($filename);
		}

		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0777, TRUE);
		}

		$today = date('Y-m-d\Th:m:s\.000\Z');

		$txt = '<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

		if($data){
			foreach($data->result() as $item){
				if($flag == "cat"){
					$txt .= "
	<url>
		<loc>". $domain . "item-list?cat_id=".$item->cat_id ."&amp;cat_name=". str_replace(' ', '-', strtolower($item->cat_name)) ."</loc>
		<lastmod>" . $today . "</lastmod>
		<changefreq>always</changefreq>
	</url>";
				}

				if($flag == "subcat"){
					$txt .= "
	<url>
		<loc>". $domain . "item-list?cat_id=".$item->cat_id ."&amp;cat_name=". str_replace(' ', '-', strtolower($this->Category->get_one($item->cat_id)->cat_name))."&amp;sub_cat_id=".$item->id ."&amp;sub_cat_name=". str_replace(' ', '-', strtolower($item->name)) ."</loc>
		<lastmod>" . $today . "</lastmod>	
		<changefreq>always</changefreq>
	</url>";
				}

				if($flag=="product"){
					
					$txt .= "
	<url>
		<loc>". $domain . str_replace(' ', '-',strtolower($item->title)) ."?item_id=".$item->id."&amp;item_name=". str_replace(' ', '-', strtolower($item->title)) ."</loc>
		<lastmod>" . $today . "</lastmod>
		<changefreq>always</changefreq>
	</url>";
				}
				
			}		
		}

		if($flag == "about"){
			$txt .='
	<url>
		<loc>' . $domain . 'about</loc>
		<lastmod>' . $today . '</lastmod>
		<changefreq>always</changefreq>
	</url>
	<url>
		<loc>' . $domain . 'contact</loc>
		<lastmod>' . $today . '</lastmod>
		<changefreq>always</changefreq>
	</url>';
		}

		$txt .= "
</urlset>";

		$file = fopen($filename, "w");
		fwrite($file, $txt);
		fclose($file);
		return realpath($filename);
	}

	// create zip file
	function createArchive(){
		$filename = 'uploads/sitemap'. '_' .  uniqid() . '.zip';
		$zip = new ZipArchive();
		if($zip->open($filename ,  ZipArchive::CREATE) === TRUE ){
			$zip->addFile('uploads/sitemap.xml', 'sitemap.xml');
		}

		$dir = "uploads/sitemaps/";
		$files= scandir($dir);

		foreach ($files as $file) {
			
			if($file != "" && $file != "." && $file != ".."){
				if(is_file($dir . $file)){
					$zip->addFile($dir . $file, 'sitemaps/'.$file); 
				}   
				
				if(is_dir($dir . $file)){
					$dir1 =$dir . $file . '/';
					$folder = 'sitemaps/'.$file . '/';
					$files= scandir($dir1);
					foreach($files as $file){
						if(is_file($dir1 . $file)){
							$zip->addFile($dir1 . $file, $folder . $file); 
						}
					}
				}
			}
		}
		
		$zip->close();
		
		return realpath($filename);
	}

	function get_domain(){
		$url = $this->Backend_config->get_one('be1')->dyn_link_deep_url;
		if(substr($url, -1) == '/'){
			$url = substr_replace($url, "", -1);
		}

		while(true){
			if(substr($url, -1) != '/'){
				$url = substr_replace($url, "", -1);
			}else{
				break;
			}
		}

		return $url;
	}
}