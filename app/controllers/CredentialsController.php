<?php

class credentialsController extends basecontroller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        //Filters
        //$this->beforefilter('csrf', array('on'=>'post'));
        $this->beforefilter('auth');
    }

    /**
     * Default page for controller
     */
    public function index()
    {

    }

    /**
     * Show the add password page.
     */
    public function getAdd()
    {
        return View::make('credentials.add');
    }

    /**
     * Add credential to database
     */
    public function postAdd()
    {
        $rules = array(
            'title' => 'required',
            'username' => 'required',
            'password' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes())
        {
            // Validation Passed
            // Generate random symmetric key
            $key = crypto::create_symmetric_key();
            // Use key to encrypt the password
            $encryptedPass = crypto::symmetric_encrypt(Input::get('password'), $key);
            // Get the intemetiary public key
            $group = Group::all()->first();
            $publicKey = base64_encode($group->publicKey);
            // Encrypt the $key with an intermeiary public key
            $encryptedKey = crypto::asymmetric_encrypt($key, $publicKey);

            // TODO: Added DB Transaction

            $cred = new credential;
            $cred->title = Input::get('title');
            $cred->username = Input::get('username');
            $cred->note = Input::get('note');
            $cred->type_id = 0;
            $cred->addedBy = Auth::user()->id;
            $cred->save();

            $encPass = new EncryptedPassword;
            $encPass->credentials_id = $cred->id;
            $encPass->password = $encryptedPass;
            $encPass->save();

            $passKey = new PasswordKey;
            $passKey->group_id = $group->id;
            $passKey->credential_id = $cred->id;
            $passKey->encryptedKey = $encryptedKey;
            $passKey->save();

            return Redirect::to('credentials/add')->with('message', 'Credential added to the database.');
        } else {
            // Validation failed
            return Redirect::to('credentials/add')->with('message', 'Error!')->withErrors($validator)->withInput();
        }

    }
}