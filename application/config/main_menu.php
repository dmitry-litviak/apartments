<?php defined('SYSPATH') or die('No direct access allowed.');
return array(
                                      "search" => array(
                                                      'title'   => 'Search page',
                                                      'url'     => 'search',
                                                      'status'  => 1
                                      ),
//                                      "feedback" => array(
//                                                      'title' 	=> 'Feedback',
//                                                      'url'    	=> 'feedback',
//                                                      'status'  => 0
//                                      ),
                                      "create_account" => array(
                                                      'title' 	=> 'Create Account',
                                                      'url'    	=> 'session/create',
                                                      'status'  => 0
                                      ),
                                      "sign_in" => array(
                                                      'title' 	=> 'User Login',
                                                      'url'    	=> 'session/login',
                                                      'status'  => 0
                                      ),
                                      "owner_sign_in" => array(
                                                      'title' 	=> 'List for Free',
                                                      'url'    	=> 'session/owner_login',
                                                      'status'  => 0
                                      ),
                                      
);