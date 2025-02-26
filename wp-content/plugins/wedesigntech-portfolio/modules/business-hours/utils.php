<?php

// Dashboard Business Hours Field
if(!function_exists('wdt_listing_business_hours_field')) {
    function wdt_listing_business_hours_field($item_id, $location = 'frontend') {

        $output = '';

        $wdt_business_hours = array ();
        $wdt_business_hours_24hour_format = '';
        if($item_id > 0) {
            $wdt_business_hours  = get_post_meta($item_id, 'wdt_business_hours', true);
            $wdt_business_hours_24hour_format  = get_post_meta($item_id, 'wdt_business_hours_24hour_format', true);
        }

        $weekdays = array (
            'sunday'    => esc_html__('Sunday','wdt-portfolio'),
            'monday'    => esc_html__('Monday','wdt-portfolio'),
            'tuesday'   => esc_html__('Tuesday','wdt-portfolio'),
            'wednesday' => esc_html__('Wednesday','wdt-portfolio'),
            'thursday'  => esc_html__('Thursday','wdt-portfolio'),
            'friday'    => esc_html__('Friday','wdt-portfolio'),
            'saturday'  => esc_html__('Saturday','wdt-portfolio'),
        );

        $timings = array (
            '' => esc_html__('OFF','wdt-portfolio'),
            '00:00' => '00:00 ('.esc_html__('midnight','wdt-portfolio').')',
            '00:30' => '00:30',
            '01:00' => '01:00',
            '01:30' => '01:30',
            '02:00' => '02:00',
            '02:30' => '02:30',
            '03:00' => '03:00',
            '03:30' => '03:30',
            '04:00' => '04:00',
            '04:30' => '04:30',
            '05:00' => '05:00',
            '05:30' => '05:30',
            '06:00' => '06:00',
            '06:30' => '06:30',
            '07:00' => '07:00',
            '07:30' => '07:30',
            '08:00' => '08:00',
            '08:30' => '08:30',
            '09:00' => '09:00',
            '09:30' => '09:30',
            '10:00' => '10:00',
            '10:30' => '10:30',
            '11:00' => '11:00',
            '11:30' => '11:30',
            '12:00' => '12:00 ('.esc_html__('noon','wdt-portfolio').')',
            '12:30' => '12:30',
            '13:00' => '13:00',
            '13:30' => '13:30',
            '14:00' => '14:00',
            '14:30' => '14:30',
            '15:00' => '15:00',
            '15:30' => '15:30',
            '16:00' => '16:00',
            '16:30' => '16:30',
            '17:00' => '17:00',
            '17:30' => '17:30',
            '18:00' => '18:00',
            '18:30' => '18:30',
            '19:00' => '19:00',
            '19:30' => '19:30',
            '20:00' => '20:00',
            '20:30' => '20:30',
            '21:00' => '21:00',
            '21:30' => '21:30',
            '22:00' => '22:00',
            '22:30' => '22:30',
            '23:00' => '23:00',
            '23:30' => '23:30',
        );

        $output .= '<ul class="wdt-business-hours-list">';

            foreach($weekdays as $weekday_key => $weekday_value) {
                $output .= '<li>';
                    $output .= '<span class="wdt-business-hours-label">'.esc_html( $weekday_value ).'</span>';
                    $output .= '<span class="wdt-business-hours-starttime">';

                        $output .= '<select name="wdt_business_hours['.esc_attr( $weekday_key ).'][start_time][]" class="wdt-chosen-select" data-placeholder="'.esc_html__('OFF', 'dtlms').'">';
                            if(count($timings) > 0) {
                                foreach($timings as $timing_key => $timing_value) {
                                    $selected_attribute = '';
                                    if(isset($wdt_business_hours[$weekday_key]['start_time']) && in_array($timing_key, $wdt_business_hours[$weekday_key]['start_time'])) {
                                        $selected_attribute = 'selected="selected"';
                                    }
                                    $output .= '<option value="'.esc_attr($timing_key).'" '.$selected_attribute.'>'.esc_html( $timing_value).'</option>';
                                }
                            }
                        $output .= '</select>';

                    $output .= '</span>';
                    $output .= '<span class="wdt-business-hours-endtime">';

                        $output .= '<select name="wdt_business_hours['.esc_attr( $weekday_key ).'][end_time][]" class="wdt-chosen-select" data-placeholder="'.esc_html__('OFF', 'dtlms').'">';
                            if(count($timings) > 0) {
                                foreach($timings as $timing_key => $timing_value) {
                                    $selected_attribute = '';
                                    if(isset($wdt_business_hours[$weekday_key]['end_time']) && in_array($timing_key, $wdt_business_hours[$weekday_key]['end_time'])) {
                                        $selected_attribute = 'selected="selected"';
                                    }
                                    $output .= '<option value="'.esc_attr($timing_key).'" '.$selected_attribute.'>'.esc_html( $timing_value).'</option>';
                                }
                            }
                        $output .= '</select>';

                    $output .= '</span>';
                $output .= '</li>';
            }

        $output .= '</ul>';

        if($location == 'backend') {

            $checked = '';
            $switchclass = 'checkbox-switch-off';
            if($wdt_business_hours_24hour_format == 'true') {
                $checked = 'checked="checked"';
                $switchclass = 'checkbox-switch-on';
            }

            $output .= '<label for="wdt_business_hours_24hour_format">'.esc_html__('24 Hour Format','wdt-portfolio').'</label>
            <div data-for="wdt_business_hours_24hour_format" class="wdt-checkbox-switch '.esc_attr( $switchclass ).'"></div>
            <input id="wdt_business_hours_24hour_format" class="hidden" type="checkbox" name="wdt_business_hours_24hour_format" value="true" '.esc_attr( $checked ).'/>';

        } else {

            $checked = '';
            if($wdt_business_hours_24hour_format == 'true') {
                $checked = 'checked="checked"';
            }

            $output .= '<div class="wdt-business-hours-24hour-format-holder">
                <input type="checkbox" name="wdt_business_hours_24hour_format" id="wdt_business_hours_24hour_format" value="true" '.esc_attr( $checked ).' />
                <label for="wdt_business_hours_24hour_format">'.esc_html__('24 Hour Format','wdt-portfolio').'</label>
            </div>';

        }

        return $output;

    }
}?>