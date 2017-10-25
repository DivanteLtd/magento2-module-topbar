# Magento 2 Topbar

Module Topbar adds simple topbar on top of the page with 3 sections:

    1) customer support e-mail
    
    2) customer support phone contact
    
    3) link to customer register/login page
    
But default module destiny was to test it via MTF(Magento Testing Framework).

## Who is developing Topbar ?
<p align="center">
    <a href="https://divante.co/">
        <img height="110" src="http://oex.pl/content/uploads/2015/05/logo_Divante-1.jpg">
    </a>
</p>

Divante has been delivering the highest quality e-commerce solutions since its inception in 2008. Our main focus is to create the most elegant and effective e-commerce services. We connect the latest technology with a great business approach.
Visit our website for more information  <a href="https://divante.co/">Divante.co</a> 

Developer: Marek Mularczyk

## Compatibility
* Module was tested on Magento 2.1.8.

## CLI usage:
* There is no CLI commands.
 
## Extensibility
* tests and also features can be easily extended via block class(Topbar.php) and template file(topbar.phtml)

## Module API (public methods)
* Module does not have API
 
## Additional information
* n/a

## Setup

#### Installation details
 
* `php bin/magento setup:upgrade`
* `php bin/magento module:enable Divante_Topbar`

#### Admin configuration

1) Support email:

go to admin panel:

        stores => 
            configuration => 
                           general => 
                              store email addresses =>
                                             customer support
 
 
2) Contact phone number:

go to admin panel:

        stores => 
                configuration => 
                          general => 
                                   general =>
                                            store information =>
                                                        store phone number
                                                    
3) Enable/Disable Topbar on front:

go to admin panel:

        stores => 
                configuration => 
                          divante extensions => 
                                               topbar =>
                                                        enable topbar    
      
## Functional tests(MTF)
Module contains 4 test cases with specified scenarios:

1) EnableTopbarTest:

   `Requirements which must be fulfilled before test start: none`
   
   Test scenario:
   * Log in to admin panel
   * Go to Stores => Configuration => Divante Extensions => Topbar
   * Set Topbar as Enabled
   * Go to home page and check that topbar is visible
   
   
2) DisableTopbarTest:

   `Requirements which must be fulfilled before test start: none`
   
   Test scenario:
   * Log in to admin panel
   * Go to Stores => Configuration => Divante Extensions => Topbar
   * Set Topbar as Disabled
   * Go to home page and check that topbar is not visible
   
   
3)  ChangeGeneralSettingsForTopbarTest:
   
    `Requirements which must be fulfilled before test start: Divante Topbar must be set to ENABLED`
    
    Test scenario:
    * Log in to admin panel
    * Go to Stores>Configuration
    * Set new general phone number for store
    * Go to home page and check that new phone is visible
    
 
4)   ChangeContactSettingsForTopbarTest:
    
     `Requirements which must be fulfilled before test start: Divante Topbar must be set to ENABLED`

     Test scenario:
     * Log in to admin panel
     * Go to Stores>Configuration>Store Email Addresses
     * Set new support email
     * Go to home page and check that new email is visible

## License
* The Topbar module is licensed under the terms of the MIT license.
    
## Standards & Code Quality
* This module respects all Magento2 code quality rules and our own PHPCS and PHPMD rulesets.
