<?php
/*
 * Created By Dedi Fardiyanto
 * Copyright (c) 2020, Inc - All Rights Reserved
 * @Filename SesTrait.php
 * @LastModified 15/09/2020, 20:03
 */

namespace App\Traits\Email;


use App\Traits\helper;

trait SesTrait
{
    use helper;

    /**
     * SesTrait constructor.
     */
    public function __construct()
    {
    }

    public function send_email_ses($request)
    {
        $params = $this->params_email_ses($request);
        //dd( $params );

        #send to recipient
        if (isset($request->recipient)) {
            # send mail
            $this->config_curl($params, $request);
        }

        #send to group/blast
        if (isset($request->group)) {

            $group = json_decode($request->group);
            $userBlast = $this->getUserByRole($group);

            #loop user by role/group
            foreach ($userBlast as $user) {
                $params['to'] = $user->email;
                $this->config_curl($params, $request);
            }

        }

    }

    public function sentEmail($params, $contentMail)
    {

    }

    private function params_email_ses($request)
    {

    }



}
