<?php

class Media_Model extends ORM {

	/**
	 * Check if a media filename is free
	 *
	 * @param   array   File params
	 * @return  boolean
	 */
	public static function path_free($file)
	{
		$name = is_array($file) ? $file['name'] : $file;
		return ! ORM::factory('media')->where('path', self::path($name))->find()->loaded;
	}

	/**
	 * Return the proper path for today
	 */
	public static function path($file)
	{
		return '/'.substr(DOCROOT.'media/uploads/'.date('Y/m'), strlen(DOCROOT)).'/'.$file;
	}
	
	/**
	 * Handle a file upload by writing a new table row
	 */
	public function file_upload($method)
	{
		$obj = ORM::factory('media');
		$obj->path = self::path($_FILES['file']['name']);
		upload::save('file', $_FILES['file']['name'], DOCROOT.'media/uploads/'.date('Y/m'));
		
		switch(pathinfo($obj->path, PATHINFO_EXTENSION))
		{
			case 'jpg':
			case 'png':
			case 'jpeg':
			case 'gif':
				$obj->type = 'image';
				break;
			case 'css':
				$obj->type = 'stylesheet';
				break;
		}
		
		$obj->save();
	}
	
	/**
	 * Handle a deletion by hooking in and deleting the file
	 *
	 * @param   integer|null
	 * @return  ORM
	 */
	public function delete($id = NULL)
	{
		if ($this->loaded)
		{
			$path = $this->path;
		}
		else
		{
			$obj = ORM::factory('media')->find($id);
			$path = $obj->path;
		}
		
		unlink(rtrim(DOCROOT,'/\\').$path);
		return parent::delete($id);
	}
	
}