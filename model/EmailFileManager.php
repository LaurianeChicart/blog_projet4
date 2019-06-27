<?php

class EmailFileManager
{
      private $_uploadFile = 'mails/mails_file.csv';

       public function updateFile($mailList)
       {
       		$file = fopen($this->_uploadFile, "w");
       		foreach($mailList as $datas)
       		{
       			fputcsv($file, array($datas['mail']), ';');
       		}
    			fclose($file);
    			header('Content-Type: text/csv');
    			header('Content-Disposition: attachment; filename="mails_file.csv"');
        }

        public function getUpload()
        {
          header('Content-Type: text/csv');
          header('Content-Disposition: attachment; filename="mails_file.csv"');
       		readfile($this->_uploadFile);
        }
}