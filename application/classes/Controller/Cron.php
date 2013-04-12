<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Cron extends My_Layout_User_Controller {

    public function action_alerts() {
        if ($this->request->query('fghgffsd')) {
            $alerts = ORM::factory('Alert')->find_all();
            foreach ($alerts as $key => $alert) {
                $types = json_decode($alert->type_id);
                $apartments = ORM::factory('Apartment')
                        ->where('lat', '>', $alert->lat - 2)
                        ->where('lat', '<', $alert->lat + 2)
                        ->where('lng', '>', $alert->lng - 2)
                        ->where('lng', '<', $alert->lng + 2);
                if (!empty($alert->from)) {
                    $apartments = $apartments->where('cost', '>', $alert->from);
                }
                if (!empty($alert->to)) {
                    $apartments = $apartments->where('cost', '<', $alert->to);
                }
                if (!empty($types)) {
                    $apartments = $apartments->where_open();
                    foreach ($types as $type_id) {
                        $apartments = $apartments->or_where('type_id', '=', $type_id);
                    }
                    $apartments = $apartments->where_close();
                }
                $apartments = $apartments->where('status', '=', 1)->count_all();
//                Helper_Main::print_flex($alert->count);
//                Helper_Main::print_flex($apartments);die;
                if ($apartments > $alert->count) {
                    $alert->count = $apartments;
                    $alert->save();
                    Library_Mail::factory()
                            ->setFrom(array('0' => 'noreply@apartments.loc'))
                            ->setTo(array('0' => $alert->user->email))
                            ->setSubject('New Alert')
                            ->setView('mail/alert', array(
                                'url' => Helper_Output::get_alert($alert),
                                'title' => $alert->title
                            ))
                            ->send();
                }
            }
        }
    }

}

