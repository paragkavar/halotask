<?php

/*
	File Name 		: usertokens.php
	Type			: Model
	Author		: Samuel Oloan Raja Napitupulu
	Modified		: 10 October 2010
	Description	: use for modelling the 'user_tokens' table from database.
				  add and delete user token for login by using cookies
*/

class Model_UserTokens extends ORM{
	
	protected $_table_name = 'user_tokens';
	protected $_primary_key = 'token_id';
	
	/*
		Adding a new user token
		use when 'remember me' checkbox is checked
	*/
	public function create_user_tokens($user_id, $token){
		$this->user_id 		= $user_id;
		$this->token 		= $token;
		$this->save();
	}
	
	public function update_user_tokens($token_id, $user_id, $token){
		$user_token = $this;
		$user_token->user_id 		= $user_id;
		$user_token->token 			= $token;
		$user_token->save();
	}
	
	public function delete_user_tokens($token_id){
		return $this->delete($token_id);
	}
	
	public function get_user_token($user_id){
		return $this->where('user_id', '=', $user_id)
					->find_all();
	}
	
	public function get_token($token){
		return $this->where('token', '=', $token)->find();
	}
}

?>