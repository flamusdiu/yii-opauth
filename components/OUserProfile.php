<?php
/**
 * OUserProfile object represents the current logged in user profile. 
 * The list of fields available in the normalized user profile structure used by HybridAuth.  
 *
 * The OUserProfile object is populated with as much information about the user as 
 * HybridAuth was able to pull from the given API or authentication provider.
 * 
 * 
 */
class OUserProfile
{
	/* The Unique user's ID on the connected provider */
	public $identifier = NULL;

	/* User website, blog, web page */
	public $webSiteURL = NULL;

	/* URL link to profile page on the IDp web site */
	public $profileURL = NULL;

	/* URL link to user photo or avatar */
	public $photoURL = NULL;

	/* User dispalyName provided by the IDp or a concatenation of first and last name. */
	public $displayName = NULL;

	/* A short about_me */
	public $description = NULL;

	/* User's first name */
	public $first_name = NULL;

	/* User's last name */
	public $last_name = NULL;

	/* male or female */
	public $gender = NULL;

	/* language */
	public $language = NULL;

	/* User age, we dont calculate it. we return it as is if the IDp provide it. */
	public $age = NULL;

	/* User birth Day */
	public $birthDay = NULL;

	/* User birth Month */
	public $birthMonth = NULL;

	/* User birth Year */
	public $birthYear = NULL;

	/* User email. Note: not all of IDp garant access to the user email */
	public $email = NULL;
	
	/* Verified user email. Note: not all of IDp garant access to verified user email */
	public $emailVerified = NULL;

	/* phone number */
	public $phone = NULL;

	/* complete user address */
	public $address = NULL;

	/* user country */
	public $country = NULL;

	/* region */
	public $region = NULL;

	/** city */
	public $city = NULL;

	/* Postal code  */
	public $zip = NULL;
	
	public function __construct($userInfo=array()){
		$iterator = new RecursiveArrayIterator($userInfo);
		
		iterator_apply($iterator, array($this,'traverseStructure'), array($iterator));
	}
		
	private function traverseStructure($iterator) {
		
		while ( $iterator -> valid() ) {
	
			if ( $iterator -> hasChildren() ) {
	
				$this->traverseStructure($iterator -> getChildren());
	
			}
			else {
				if (property_exists($this, $iterator->key())) {
					$this->{$iterator->key()} = $iterator->current();
				}
			}
	
			$iterator -> next();
		}
	}
}
