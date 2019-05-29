<?php

class Autoloader
{
	public static function start()
	{
		spl_autoload_register(function ($class)
		{
			if (file_exists($file = 'classes/' . $class . '.php'))
			{
				require $file;
			}
			elseif (file_exists($file = 'controller/' . $class . '.php'))
			{
				require $file;
			}
			elseif (file_exists($file = 'model/' . $class . '.php'))
			{
				require $file;
			}
			
		});
	}

	
}