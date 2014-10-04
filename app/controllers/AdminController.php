<?php

class adminController extends BaseController
{
    /*
     * Use constructor do define permissions for controller.
     */
    public function __construct()
    {
        // Require authenticated users
        $this->beforeFilter('auth');
        $this->beforeFilter(function()
        {
            // Check if user is admin.
            If (!Auth::user()->isAdmin) return Redirect::to('/');
                // Send user back to priviouse page with a message.
        });
    }

    /*
     * Admin Homepage
     */
    public function getIndex()
    {
        return View::make('admin.index');
    }

    /*
     * Group management
     */
    public function getGroups()
    {
        // Get all the current groups
        $groups = Group::all();

        return View::make('admin.groups', array('groups' => $groups));
    }

    /*
     * Add group
     */
    public function postGroups()
    {
        //Validation
        $validator = Validator::make(Input::all(), array('groupname'=>'required|alpha|min:2'));

        if ($validator->passes())
        {   
            // Validation Passed, create and add group
            $keys = crypto::create_asymmetric_keypair(3072);
            $group = new Group;
            $group->name = Input::get('groupname');
            $group->publicKey = base64_decode($keys['public']);
            $group->created_by = Auth::user()->id;
            // Store the private key in the groupKeys table
            // TODO: encrypt group private key
            $groupKey = new GroupKey;
            $groupKey->user_id = Auth::user()->id;
            $groupKey->encryptedKey = base64_decode($keys['private']);
            
            // Use a transation to rollback changes if fails this way to make sure we have saved or public and private keys
            DB::transaction(function() use ($group, $groupKey)
            {
                // First Save group to get ID
                $group->save();
                // Update groupKey and save
                $groupKey->group_id = $group->id;
                $groupKey->save();

            });
            return Redirect::to('admin/groups')->with('message', 'Group Added!');
        } else {
            // Validation failed
            return Redirect::to('admin/groups')->with('message', 'Group Add Failed!')->withErrors($validator)->withInput();
        }
    }

    /*
     * User management
     */
    public function getUsers()
    {
        $users = User::all();
        return View::make('admin.users', array('users'=>$users));
    }
}