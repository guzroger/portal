<?php

class Ldap{
	
	public function validarLDAP($login,$pass){
	   //Variables de configuracion para la coneccion a LDAP
  
  		//Looking User Information into the Windows 2003 Active Directory 
		//Configurarion Section 
		$ldap_server="192.9.200.51";         //The Active Directory Server 
		$ad_domainNB="COMTECO";              //The Netbios name of the domain 
  		$ad_domain="comteco.net";              
  		$domain_parts = explode(".",$ad_domain);   //Extract every part of the domain 
  		$ad_base_search=""; 
		
		//Upper Case Parts and Build a base search string
		for ($x=0;$x<sizeof($domain_parts);$x++)   
		{ 
     			$domain_parts[$x] = strtoupper($domain_parts[$x]); 
     			if ($x==sizeof($domain_parts)-1) 
         		{ 
            	 		$ad_base_search .= "dc=" . $domain_parts[$x]; 
         		} 
        		else 
         		{ 
           		 	$ad_base_search .= "dc=" . $domain_parts[$x] . ","; 
         		}    
 		} 
    
		$ds=ldap_connect($ldap_server);//Conecting to the Server 
		
		if ($ds) //if Conection is ok we continue 
		{ 

			//Setting the Ldap Query options 
        		ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3); 
	        	
			//Setting the Ldap Query options 
    	    		ldap_set_option($ds, LDAP_OPT_REFERRALS, 0); 
	        	
			//Validation with the Active Directory 
	        	@$r=ldap_bind($ds,$ad_domainNB . '\\' .$login, $pass );
			
			if(@$r==1)// luego verifica esa parte en mi base de dat
			{
				//return $this->VerificarBDORACLE($login, '');
				return 1;
			}
			else
				return 0;	
	
		}
		else
		{
			//Error de coneccion
			return 2;
		}
	}

	public function getValues($login,$pass){
		set_time_limit(30);
		error_reporting(E_ALL);
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors',1);

		// config
		$ldapserver="192.9.200.51"; 
		$ldapuser      = $login;  
		$ad_domainNB="COMTECO";
		$ldappass     = $pass;
		$ldaptree    = "dc=COMTECO,dc=NET";

		// connect 
		$ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");

		if($ldapconn) {
		    // binding to ldap server
		    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3); 
		                
		    //Setting the Ldap Query options 
		    ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0); 
		    
			$ldapbind = ldap_bind($ldapconn,$ad_domainNB . '\\' .$ldapuser, $ldappass );
		    // verify binding
		    if ($ldapbind) {
		        
		        $attr = array("*");

		        $result = ldap_search($ldapconn,$ldaptree, "(&(mailnickname=$login))", $attr);
		        
		        $data = ldap_get_entries($ldapconn, $result);

		        return $data;
		    }
		}
		// all done? clean up
		ldap_close($ldapconn);
	}
}

/*REALIZANDO LAS PRUEBAS	
$conexionGeneric=new conexionGeneric();

$res=$conexionGeneric->validarLDAP('a','a');
if($res==1){
echo 'Este usuario existe en la base de datos LDAP';

}else{
echo 'error.. no existes en la base de datos LDAP';

}
*/
//echo 'realizado las pruebas';
?>