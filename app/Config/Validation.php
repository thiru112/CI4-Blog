<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single'
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------

	public $signup = [
		"e_mail" => ["label" => "email", "rules" => "required|valid_email"],
		"uname" => ["label" => "Username", "rules" => "required|alpha_numeric"],
		"passwd" => ["label" => "pass_wd", "rules" => "required|min_length[5]"],
		"confirm_pass" => ["label" => "re-pass", "rules" => "required|matches[passwd]"]
	];

	public $postvalid = [
		'post_title' => 'required|alpha_numeric_space',
		'post_content' => 'required',
		'post_category' => 'required'
	];

	public $postvalid_errors = [
		"post_title" => [
			"required" => "Post title should not be empty"
		],
		"post_content" => [
			"required" => "Post content should not be empty"
		],
		"post_category" => [
			"required" => "Choose atleast a single category"
		]
	];

	public $categoryvalid = [
		"category_name" => "required|alpha_space"
	];

	public $categoryvalid_errors = [
		"category_name" => [
			"required" => "Category cannot be empty",
			"alpha_space" => "Should contain only alphabets only"
		]
	];
}
