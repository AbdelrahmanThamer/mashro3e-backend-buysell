<?php
    $flag = true;

    function copySitemap(){

        $uri = $_SERVER['REQUEST_URI'];

        $filepath = explode('=',$uri);
        $filepath = $filepath[1];
            
        global $flag;

        if($filepath != '' && $filepath != null){

            // extract zip file
            $zip = new ZipArchive;
            $res = $zip->open($filepath);
            if ($res === TRUE) {
                $zip->extractTo(getcwd());
                $zip->close();
                $flag = true;
            } else {
                $flag = false;
            }
        }
        
        if($flag){
            return "Sitemap has been added successfully.";
        }else{
            return "Unable to copy.";
        }
    }

    function get_fe_url(){
    
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $link = "https";
        else $link = "http";
        
        $link .= "://";
        
        $link .= $_SERVER['HTTP_HOST'];
        
        $link .= $_SERVER['REQUEST_URI'];
        
        return substr($link, 0 ,strpos($link, 'getsitemap.php'));

    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">        
        <script>
            alert("<?php echo copySitemap()?>");
        </script>
    </head>
    
    <body class="bg-info" >
        
        <?php if(file_exists('sitemap.xml')): ?>
        <div class="card col-md-6 offset-md-3 mt-5 col-10 offset-1 p-5 shadow rounded bg-light ">
            <ul>
                <h5>Generated Sitemap Files Here</h5>
                <li><a href="<?php echo get_fe_url() . 'sitemap.xml'; ?>" target="_blank"><?php echo  get_fe_url() . 'sitemap.xml'; ?></a></li>
                <?php
                if(is_dir('sitemaps')){
                    $dir = "sitemaps/";
                    $files= scandir($dir);
    
                    foreach ($files as $file) {
                        
                        if($file != "" && $file != "." && $file != ".."){
                            if(is_file($dir . $file)){
                            ?>
                            <li><a href="<?php echo get_fe_url() . $dir . $file ; ?>" target="_blank"><?php echo  get_fe_url() . $dir . $file; ?></a></li>
                           <?php
                            }   
                            
                            if(is_dir($dir . $file)){
                                $dir1 =$dir . $file . '/';
                                $folder = 'sitemaps/'.$file . '/';
                                $files= scandir($dir1);
                                foreach($files as $file){
                                    if(is_file($dir1 . $file)){
                                        ?>
                                        <li><a href="<?php echo get_fe_url() . $folder . $file ; ?>" target="_blank"><?php echo  get_fe_url() . $folder . $file; ?></a></li>
                                        <?php
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php if(!file_exists('sitemap.xml')): ?>
            <div class="fixed-top mt-5 col-6 offset-3 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Sitemap file is not existed.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

    </body>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</html>