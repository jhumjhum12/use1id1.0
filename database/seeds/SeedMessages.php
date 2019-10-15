<?php

use Illuminate\Database\Seeder;

class SeedMessages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $messages = [
            "invalid_UID" => "User ID & does not exist in the system",
            "incorrect_pass" => "Incorrect password for User ID &",
            "UID_locked" => "User ID & is locked in the system. Reset here.",
            "invalid_pass" => "Password contains not allowed pattern &",
            "passes_not_matching" => "Passwords do not match",
            "invalid_ref_code" => "Reference code & does not exist",
            "email_exists" => "E-mail is already existing in our system",
            "invalid_email" => "Invalid e-mail address",
            "phone_exists" => "Phone number already exists in our system",
            "invalid_phone" => "Invalid Phone number",
            "empty_fname" => "First Name has to be filled",
            "empty_lname" => "Last Name has to be filled",
            "fill_email_or_phone" => "Fill either e-mail or phone number",
            "accept_single_user_agr" => "First and Last name should be the one on your ID or passport. Accept Single User Agreement.",
            "not_activated" => "Not activated (use e-mail to activate)",
            "are_you_sure" => "Are you sure? Y/N",
            "no_&" => "Should not contain &",
            "no_first_last_name" => "Should not contain first or lastname",
            "different_banks" => "this only makes sense if the banks are different",
            "upload_to_MyID" => "Upload to MyID account",
            "eg_upload_invoice" => "e.g. You upload an invoice in the monitor and pay",
            "upload_first_to_virtual" => "you have to upload first to your virtual account",
            "currency_match" => "Not \"yet\" to your own accounts (currency match)",
            "pay_invoice" => "Pay an invoice with your virtual account",
            "pay_CID" => "Pay a CID (connected)",
            "account_not_in_personal1" => "If an account is not in your Personal accounts you can not pay from it",
            "account_not_in_personal2" => "If an account is not in your Personal accounts you can not pay from it",
            "account_not_in_personal3" => "If an account is not in your Personal accounts you can not pay from it",
            "account_not_in_personal4" => "If an account is not in your Personal accounts you can not pay from it",
            "only_through_CID1" => "Can only be done through CID profile access",
            "only_through_CID2" => "Can only be done through CID profile access",
            "only_through_CID3" => "Can only be done through CID profile access",
            "only_through_CID4" => "Can only be done through CID profile access"
        ];
		
        DB::table('messages')->truncate();

        foreach($messages as $key => $message) {

            DB::table('messages')->insert(
                [
                    "lang" => "EN",
					"key" => $key,
                    "msg_txt" => $message,
                    "context" => "",
                   
                ]
            );
        }
		

		$errors = [
			/*
			|--------------------------------------------------------------------------
			| Validation Language Lines
			|--------------------------------------------------------------------------
			|
			| The following language lines contain the default error messages used by
			| the validator class. Some of these rules have multiple versions such
			| as the size rules. Feel free to tweak each of these messages here.
			|
			*/

			'accepted'             => 'The :attribute must be accepted.',
			'active_url'           => 'The :attribute is not a valid URL.',
			'after'                => 'The :attribute must be a date after :date.',
			'alpha'                => 'The :attribute may only contain letters.',
			'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
			'alpha_num'            => 'The :attribute may only contain letters and numbers.',
			'array'                => 'The :attribute must be an array.',
			'before'               => 'The :attribute must be a date before :date.',
			'between'              => [
				'numeric' => 'The :attribute must be between :min and :max.',
				'file'    => 'The :attribute must be between :min and :max kilobytes.',
				'string'  => 'The :attribute must be between :min and :max characters.',
				'array'   => 'The :attribute must have between :min and :max items.',
			],
			'boolean'              => 'The :attribute field must be true or false.',
			'confirmed'            => 'The :attribute confirmation does not match.',
			'date'                 => 'The :attribute is not a valid date.',
			'date_format'          => 'The :attribute does not match the format :format.',
			'different'            => 'The :attribute and :other must be different.',
			'digits'               => 'The :attribute must be :digits digits.',
			'digits_between'       => 'The :attribute must be between :min and :max digits.',
			'dimensions'           => 'The :attribute has invalid image dimensions.',
			'distinct'             => 'The :attribute field has a duplicate value.',
			'email'                => 'The :attribute must be a valid email address.',
			'exists'               => 'The selected :attribute is invalid.',
			'file'                 => 'The :attribute must be a file.',
			'filled'               => 'The :attribute field is required.',
			'image'                => 'The :attribute must be an image.',
			'in'                   => 'The selected :attribute is invalid.',
			'in_array'             => 'The :attribute field does not exist in :other.',
			'integer'              => 'The :attribute must be an integer.',
			'ip'                   => 'The :attribute must be a valid IP address.',
			'json'                 => 'The :attribute must be a valid JSON string.',
			'max'                  => [
				'numeric' => 'The :attribute may not be greater than :max.',
				'file'    => 'The :attribute may not be greater than :max kilobytes.',
				'string'  => 'The :attribute may not be greater than :max characters.',
				'array'   => 'The :attribute may not have more than :max items.',
			],
			'mimes'                => 'The :attribute must be a file of type: :values.',
			'mimetypes'            => 'The :attribute must be a file of type: :values.',
			'min'                  => [
				'numeric' => 'The :attribute must be at least :min.',
				'file'    => 'The :attribute must be at least :min kilobytes.',
				'string'  => 'The :attribute must be at least :min characters.',
				'array'   => 'The :attribute must have at least :min items.',
			],
			'not_in'               => 'The selected :attribute is invalid.',
			'numeric'              => 'The :attribute must be a number.',
			'present'              => 'The :attribute field must be present.',
			'regex'                => 'The :attribute format is invalid.',
			'required'             => 'The :attribute field is required.',
			'required_if'          => 'The :attribute field is required when :other is :value.',
			'required_unless'      => 'The :attribute field is required unless :other is in :values.',
			'required_with'        => 'The :attribute field is required when :values is present.',
			'required_with_all'    => 'The :attribute field is required when :values is present.',
			'required_without'     => 'The :attribute field is required when :values is not present.',
			'required_without_all' => 'The :attribute field is required when none of :values are present.',
			'same'                 => 'The :attribute and :other must match.',
			'size'                 => [
				'numeric' => 'The :attribute must be :size.',
				'file'    => 'The :attribute must be :size kilobytes.',
				'string'  => 'The :attribute must be :size characters.',
				'array'   => 'The :attribute must contain :size items.',
			],
			'string'               => 'The :attribute must be a string.',
			'timezone'             => 'The :attribute must be a valid zone.',
			'unique'               => 'The :attribute has already been taken.',
			'uploaded'             => 'The :attribute failed to upload.',
			'url'                  => 'The :attribute format is invalid.',

			/*
			|--------------------------------------------------------------------------
			| Custom Validation Language Lines
			|--------------------------------------------------------------------------
			|
			| Here you may specify custom validation messages for attributes using the
			| convention "attribute.rule" to name the lines. This makes it quick to
			| specify a specific custom language line for a given attribute rule.
			|
			*/

			'custom' => [
				'attribute-name' => [
					'rule-name' => 'custom-message',
				],
			],

			/*
			|--------------------------------------------------------------------------
			| Custom Validation Attributes
			|--------------------------------------------------------------------------
			|
			| The following language lines are used to swap attribute place-holders
			| with something more reader friendly such as E-Mail Address instead
			| of "email". This simply helps us make messages a little cleaner.
			|
			*/

			'attributes' => [],

		];

		// build 1D array
		$errorsM = [];
		$r = new RecursiveIteratorIterator(new RecursiveArrayIterator($errors));
		foreach ($r as $val) {
			$keys = [];
			foreach (range(0, $r->getDepth()) as $depth) {
				$keys[] = $r->getSubIterator($depth)->key();
			}
			$errorsM[ join('.', $keys) ] = $val;
		}
		
		foreach($errorsM as $key => $message) {

            DB::table('messages')->insert(
                [
                    "lang" => "EN",
					"key" => $key,
                    "msg_txt" => $message,
                    "context" => "laravel",
                    
                ]
            );
        }
    }
}
