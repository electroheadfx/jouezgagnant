<?php defined('SYSPATH') or die('No direct script access.');

class Migration_Mysql_Driver extends Migration_Driver
{
	public function __construct($db)
	{
		parent::__construct($db);
		
		$this->db->query('START TRANSACTION');
	}
	
	public function __destroy()
	{
		$this->db->query('COMMIT');
	}
	
	protected function rollback()
	{
		$this->db->query('ROLLBACK');
	}
	
	public function create_table($table_name, $fields, $primary_key = TRUE)
	{
		$sql = "CREATE TABLE `$table_name` (";

		// add a default id column if we don't say not to
		if ($primary_key === TRUE)
		{
			$primary_key = 'id';
			$fields = array_merge(array('id' => array('integer', 'null' => FALSE)), $fields);
		}
		
		foreach ($fields as $field_name => $params)
		{
			$params = (array) $params;
			
			if ($primary_key === $field_name AND $params[0] == 'integer')
			{
				$params['auto'] = TRUE;
			}
			
			$sql .= $this->compile_column($field_name, $params);
			$sql .= ",";
		}

		$sql = rtrim($sql, ',');

		if ($primary_key)
		{
			$sql .= ' , PRIMARY KEY (';
			
			foreach ( (array) $primary_key as $pk ) {
				$sql .= " `$pk`,";
			}
			$sql = rtrim($sql, ',');
			$sql .= ')';
		}

		$sql .= ")";

		return $this->run_query($sql);
	}

	public function drop_table($table_name)
	{
		return $this->run_query("DROP TABLE $table_name");
	}

	public function rename_table($old_name, $new_name)
	{
		return $this->run_query("RENAME TABLE `$old_name`  TO `$new_name` ;");
	}
	
	public function add_column($table_name, $column_name, $params)
	{
		$sql = "ALTER TABLE `$table_name` ADD COLUMN " . $this->compile_column($column_name, $params, TRUE);
		return $this->run_query($sql);
	}

	public function rename_column($table_name, $column_name, $new_column_name)
	{
		$params = $this->get_column($table_name, $column_name);
		$sql    = "ALTER TABLE `$table_name` CHANGE `$column_name` " . $this->compile_column($new_column_name, $params);
		return $this->run_query($sql);
	}
	
	public function change_column($table_name, $column_name, $params)
	{
		$sql = "ALTER TABLE `$table_name` MODIFY " . $this->compile_column($column_name, $params);
		return $this->run_query($sql);
	}
	
	public function remove_column($table_name, $column_name)
	{
		return $this->run_query("ALTER TABLE $table_name DROP COLUMN $column_name ;");
	}
	
	public function add_index($table_name, $index_name, $columns, $index_type = 'normal')
	{
		switch ($index_type)
		{
			case 'normal':   $type = ''; break;
			case 'unique':   $type = 'UNIQUE'; break;
			case 'primary':  $type = 'PRIMARY'; break;
			
			default: throw new Exception('migrations.bad_index_type', $index_type);
		}
		
		$sql = "ALTER TABLE `$table_name` ADD $type INDEX `$index_name` (";
		
		foreach ((array) $columns as $column)
		{
			$sql .= " `$column`,";
		}
		
		$sql  = rtrim($sql, ',');
		$sql .= ')';
		return $this->run_query($sql);
	}

	public function remove_index($table_name, $index_name)
	{
		return $this->run_query("ALTER TABLE `$table_name` DROP INDEX `$index_name`");
	}
	
	protected function compile_column($field_name, $params, $allow_order = FALSE)
	{
		if (empty($params))
		{
			throw new Kohana_Exception('migrations.missing_argument');
		}
		
		$params   = (array) $params;
		$null     = TRUE;
		$auto     = FALSE;
		$unsigned = TRUE;
		
		foreach ($params as $key => $param)
		{
			$args = NULL;

			if (is_string($key))
			{
				switch ($key)
				{
					case 'after':    if ($allow_order) $order = "AFTER `$param`"; break;
					case 'null':     $null = (bool) $param; break;
					case 'default':  $default = 'DEFAULT ' . ($param == 'CURRENT_TIMESTAMP' ? $param : $this->db->escape( (string) $param)); break;
					case 'auto':     $auto = (bool) $param; break;
					case 'unsigned': $unsigned = (bool) $param; break;
					default: throw new Kohana_Exception('migrations.bad_column', $key);
				}
				continue; // next iteration
			}
			
			// Split into param and args
			if (is_string($param) AND preg_match('/^([^\[]++)\[(.+)\]$/', $param, $matches))
			{
				$param = $matches[1];
				$args  = $matches[2];

				// Replace escaped comma with comma
				$args = str_replace('\,', ',', $args);
			}
			
			if ($this->is_type($param))
			{
				$type   = $param;
				$native = $this->native_type($param, $args);
				continue;
			}
			
			switch ($param)
			{
				case 'first':   if ($allow_order) $order = 'FIRST'; continue 2;
				default: break;
			}

			throw new Kohana_Exception('migrations.bad_column', $param);
		}

		if (empty($native))
		{
			throw new Kohana_Exception('migrations.missing_argument');
		}

		$sql  = " `$field_name` $native ";

		$sql .= (($unsigned AND $type == 'integer') ? ' UNSIGNED ' : '');
		$sql .= $null     ? ' NULL ' : ' NOT NULL ';
		isset($default)   and $sql .= " $default ";
		$sql .= $auto     ? ' AUTO_INCREMENT ' : '';
		isset($order)     and $sql .= " $order ";
		
		return $sql;
	}
	
	protected function get_column($table_name, $column_name)
	{
		$result = $this->db->query("SHOW COLUMNS FROM `$table_name` LIKE '$column_name'");

		if ($result->count() !== 1)
		{
			throw new Kohana_Exception('migrations.column_not_found', $column_name, $table_name);
		}
		
		$result = $result->current();
		$params = $this->migration_type(strtolower($result->Type));
		
		if (strtolower($result->Null) == 'no')
			$params['null'] = FALSE;

		if ($result->Default)
			$params['default'] = $result->Default;
			
		if (strtolower($result->Extra) == 'auto_increment')
			$params['auto'] = TRUE;
		
		return $params;
	}

	protected function default_limit($type)
	{
		switch ($type)
		{
			case 'decimal': return "10,0";
			case 'integer': return "normal";
			case 'string':  return "255";
			case 'binary':  return "1";
			case 'boolean': return "1";
			default: return "";
		}
	}
	
	protected function native_type($type, $limit)
	{
		if (!$this->is_type($type))
		{
			throw new Kohana_Exception('migrations.unknown_type', $type);
		}
		
 		if (empty($limit))
 		{
 			$limit = $this->default_limit($type);
 		}
 		
 		switch ($type)
		{
			case 'integer':
				switch ($limit)
				{
					case 'big':    return 'BIGINT';
					case 'normal': return 'INT';
					case 'small':  return 'SMALLINT';
					default: break;
				}
				throw new Kohana_Exception('migrations.unknown_type', $type);
				
			case 'string': return "VARCHAR ($limit)";
			case 'boolean': return 'TINYINT (1)';
			default: return $limit ? "$type ($limit)" : $type;
		}
	}
	
	protected function migration_type($native)
	{
		if (preg_match('/^([^\(]++)\((.+)\)\s*(\w+?)$/', $native, $matches))
		{
			$native = $matches[1];
			$limit  = $matches[2];
			$option = count($matches) >= 4 ? $matches[3] : '';
		}

		// quick checks
		if ($native == 'tinyint')
			return (array)'boolean';
		elseif ($native == 'varchar')
			return (array)"string[$limit]";

		if (strpos($native, 'int') !== FALSE)
		{
			switch ($native)
			{
				case 'bigint':   $type = (array)'integer[big]'; break;
				case 'smallint': $type = (array)'integer[small]'; break;
				default:         $type = (array)'integer'; break;
			}
			if ($option == 'unsigned')
			{
				$type['unsigned'] = TRUE;
			}
			
			return $type;
		}
		
		if (!$this->is_type($native))
		{
			throw new Kohana_Exception('migrations.unknown_type', $native);
		}
		
		return (array)($native . "[$limit]");
	}
}