<?php

class Svn {

    // params that are common to all commands
    private $common_params = '--no-auth-cache';
    // set to TRUE to show the svn command
    private $show_debug = FALSE;

    public function debug($svn_command)
    {
        if($this->show_debug)
        {
            echo '<p>'.$svn_command.'</p>';
        }
    }

/*
 * 
 * name: exec
 * @param $command an svn command
 * @param $options an array with options for the command
 * @return 
 */ 
    private function exec($command, $options = array())
    {
        $output = FALSE;
        if(!empty($command))
        {
			if( $command == "add" ){
				$svn_command = 'svn --no-auth-cache '.$command.' '.implode(' ',$options);
			}else{
				$svn_command = 'svn --no-auth-cache '.$command.' '.$this->common_params.' '.implode(' ',$options);
			}
            if($this->show_debug)
            {
                echo '<p>'.$svn_command.'</p>';
            }

            $output = array();
			$o = array();
			
            exec("export LC_ALL=en_US.UTF-8 ; " . $svn_command."  2>&1", $output);
			
			/*
			exec("locale 2>&1", $o);
			
			if( file_exists("projects/log.txt") ){
				$log = file_get_contents("projects/log.txt");
			}else{
				$log = "";
			}
			
			$log .= "\r\n -----------------------------\r\n";
			$log .= $svn_command;
			$t = implode("\n\r",$output);
			$t1 = implode("\n\r",$o);
			$log .= $t;
			$log .= $t1;
			$log .= "\r\n -----------------------------\r\n";
			
			file_put_contents("projects/log.txt",$log);
			*/
        }

        return $output;
    }

/*
 * 
 * name: checkout
 * @param $svn_url 
 * @param $target target directorio. By default use current
 * @param $params_str to include other options for svn
 * @return an array with the output of the command
 */ 
    public function checkout($svn_url, $target = '', $params_str = '')
    {
        return $this->exec('co',array($params_str,$svn_url,$target));
        return $this->exec('commit',array($params_str,$svn_url,$target));
        //$svn_command = 'svn --no-auth-cache ' . $params_str . ' co ' . $svn_url . ' ' . $target; 
        //$this->debug($svn_command);

        //$output = array();
        //exec($svn_command, $output);
        //return $output;
    }

/*
 * 
 * name: ls
 * @param $svn_url
 * @param $params_str to include other options for svn 
 * @return an array with the output of the command
 */ 
    public function ls($svn_url, $params_str = '')
    {
        return $this->exec('ls',array($params_str,$svn_url));
        //$svn_command = 'svn --no-auth-cache ' . $params_str . ' ls ' . $svn_url; 
        //$this->debug($svn_command);
        //$output = array();
        //exec($svn_command, $output);
        //return $output;
    }

/*
 * 
 * name: up
 * @param $target folder to be updated. Current folder by default.
 * @param $params_str to include other options for svn 
 * @return an array with the output of the command
 */ 
    public function up($target = '', $params_str)
    {
        return $this->exec('up',array($params_str,$target));
        //$svn_command = 'svn --no-auth-cache ' . $params_str . ' up ' . $file; 
        //$this->debug($svn_command);
        //$output = array();
        //exec($svn_command, $output);
        //return count($output)>0&&file_exists($file);
    }

/*
 * 
 * name: status
 * @param $target folder to get status. Current folder by default.
 * @param $params_str to include other options for svn 
 * @return an array with the output of the command
 */ 
    public function status($target = '', $params_str)
    {
        return $this->exec('st',array($params_str,$target));
        //$svn_command = 'svn --no-auth-cache ' . $params_str . ' st ' . $target; 
        //$this->debug($svn_command);

        //$output = array();
        //exec($svn_command, $output);
        //return $output;
    }

/*
 * 
 * name: commit
 * @param $target folder to commit. Current folder by default.
 * @param $params_str to include other options for svn 
 * @return an array with the output of the command
 */ 
    public function commit($target = '', $params_str)
    {
        return $this->exec('commit',array($params_str,$target));
        //$svn_command = 'svn --no-auth-cache ' . $params_str . ' commit ' . $target . ' -m "Commited from web"'; 
        //$this->debug($svn_command);

        //$output = array();
        //exec($svn_command, $output);

        //return $output;
    }
/*
 * 
 * name: cleanup
 * @param $target folder to commit. Current folder by default.
 * @param $params_str to include other options for svn 
 * @return an array with the output of the command
 */ 
    public function cleanup($target = '', $params_str)
    {
        return $this->exec('cleanup',array($params_str,$target));
        //$svn_command = 'svn --no-auth-cache ' . $params_str . ' commit ' . $target . ' -m "Commited from web"'; 
        //$this->debug($svn_command);

        //$output = array();
        //exec($svn_command, $output);

        //return $output;
    }

	
/*
 * 
 * name: add
 * @param $target to add.
 * @param $params_str to include other options for svn 
 * @return an array with the output of the command
 */ 
    public function add($target, $params_str)
    {
        return $this->exec('add',array($params_str,$target));
        //$svn_command = 'svn --no-auth-cache ' . $params_str . ' add ' . $target; 
        //$this->debug($svn_command);

        //$output = array();
        //exec($svn_command, $output);
        //return $output;
    }

/*
 * 
 * name: add_all
 * @description to add all files that need to be added
 * @param $target folder to check if there are files to add
 * @param $params_str to include other options for svn 
 * @return 
 */ 
    public function add_all($target, $params_str)
    {
        $result = FALSE;
        if(file_exists($target))
        {
            $output = $this->status($target, $params_str);
			
            if(count($output)>0)
            {
                foreach($output as $o)
                {
                    if(substr($o,0,1)=="?" || substr($o,0,1)=="A")
                    {
                        $this->add( '"'.trim(substr($o,1)).'"','');
                    }
                }
            }

            $result = TRUE;
        }

        return $result;
    }

}
