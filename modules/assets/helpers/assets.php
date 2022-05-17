<?php defined('SYSPATH') or die('No direct script access.');
class assets_Core {
    /**
     * Method: stylesheet
     *  Creates a stylesheet link.
     *
     * Parameters:
     *  style - filename
     *  media - media type of stylesheet
     *  index  - include the index_page in the link
     *
     * Returns:
     *  An HTML stylesheet link.
     */
    public static function stylesheet($style, $media = FALSE, $index = TRUE)
    {
		return html::link(self::glue($style, '.css'), 'stylesheet', 'text/css', '.css', $media, $index);
    }

    /**
     * Method: script
     *  Creates a script link.
     *
     * Parameters:
     *  script - filename
     *  index  - include the index_page in the link
     *
     * Returns:
     *  An HTML script link.
     */
    public static function script($script, $index = TRUE)
    {
        $script = rtrim(self::glue($script, '.js'), '.js').'.js';
        return '<script type="text/javascript" src="'.url::base((bool) $index).$script.'"></script>';
    }
    
    private static function glue($files, $ext)
    {
        $local_path = APPPATH.'views/';
	
		$files = array_unique( (array) $files);

		$last_modified = self::getLastModified($files, $local_path, $ext.EXT);
		if (Kohana::config('assets.rehash_on_modified')) {
			$hash = array_merge($files, array($last_modified));
		} else {
			$hash = $files;
		}
        $filename = 'assets/'.str_replace('.', '', $ext).'/'.md5(implode('', $hash));
        $filesrc = $local_path.$filename.$ext;

        if ( ! file_exists($filesrc) or filemtime($filesrc) < $last_modified) 
		{
    	    ob_start();
                
	    	foreach($files as $script) 
	    	{
                $suffix = (strpos($script, $ext) === FALSE) ? $ext : '';
                echo View::factory($script.$suffix);
            }
                
	    	file_put_contents($filesrc, ob_get_clean(), LOCK_EX);
		}
	    
        return $filename;
    }

    private static function getLastModified($files, $path, $ext)
    {
        $lastModified = 0;
        
		foreach($files as $file) 
		{
            $suffix = (strpos($file, $ext) === FALSE) ? $ext : '';
            $modified = filemtime($path.$file.$suffix);
            
	    	if($modified !== false and $modified > $lastModified) 
                $lastModified = $modified;
        }

        return $lastModified;
    }

} // End Assets Helper