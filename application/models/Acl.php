<?php 

class Application_Model_Acl extends Zend_Acl
{
	public function __construct()
	{
		// ACL for default role
		$this->addRole(new Zend_Acl_Role('unregistered'))
			 ->add(new Zend_Acl_Resource('public'))
			 ->add(new Zend_Acl_Resource('error'))
			 ->allow('unregistered', array('public','error'));
			 
		// ACL for client
		$this->addRole(new Zend_Acl_Role('client'), 'unregistered')
			 ->add(new Zend_Acl_Resource('client'))
			 ->allow('client','client');
				   
		// ACL for administrator
		$this->addRole(new Zend_Acl_Role('admin'), 'client')
			 ->add(new Zend_Acl_Resource('admin'))
			 ->allow('admin','admin');
                // ACL for staff 
                $this->addRole(new Zend_Acl_Role('staff'),'client')
                        ->add(new Zend_Acl_Resource('staff'))
                        ->allow('staff','staff');                        
	}
}