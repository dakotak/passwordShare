<?php

class UserController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>array('getProfile')));
    }

    /**
     * Show the user registration form.
     */
    public function getRegister()
    {
        return View::make('user.register');
    }

    /**
     * Show login form.
     */
    public function getLogin()
    {
        return View::make('user.login');
    }

    /**
     * Log user in.
     */
    public function postLogin()
    {
        if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password'))))
        {
            return Redirect::to('')->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('user/login')->with('message', 'Your username/password combination was incorrect')->withInput();
        }
    }

    /**
    * Log user out
    */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('user/login')->with('message', 'You are now logged out!');
    }

    public function postCreate()
    {
        $rules = array(
            'firstname'=>'required|alpha|min:2',
            'lastname'=>'required|alpha|min:2',
            'username'=>'required|alpha|unique:users',
            'password'=>'required|alpha_num|between:6,12|confirmed',
            'password_confirmation'=>'required|alpha_num|between:6,12'
            );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes())
        {
            // Validation has pased, create the user
            // Create a asymmetric keypair
            $keys = crypto::create_asymmetric_keypair(3072);
            $user = new User;
            $user->firstName = Input::get('firstname');
            $user->lastName = Input::get('lastname');
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->publicKey = $keys['public'];
            $user->privateKey = $keys['private'];
            $user->save();

            return Redirect::to('user/login')->with('message', 'Registration complete.');
        } else {
            // Validation has failed, display errors
            return Redirect::to('user/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

    public function getProfile()
    {
        return View::make('user.profile');
    }
}