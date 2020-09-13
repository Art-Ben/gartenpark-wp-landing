<?php
/**
 * Custom contact orm ajax handler function
 */
add_filter('acf/load_field/name=client_name', 'acf_read_only');
add_filter('acf/load_field/name=client_lastname', 'acf_read_only');
add_filter('acf/load_field/name=client_tel', 'acf_read_only');
add_filter('acf/load_field/name=client_email', 'acf_read_only');
add_filter('acf/load_field/name=client_type', 'acf_read_only');
add_filter('acf/load_field/name=client_message', 'acf_read_only');

function acf_read_only($field) {
	$field['readonly'] = 1;
	return $field;
}

if( !function_exists('ajax_contact_form') ) {
    add_action( 'wp_ajax_sendcontactform', 'ajax_contact_form' );
	add_action( 'wp_ajax_nopriv_sendcontactform', 'ajax_contact_form' );

    function curl_post($url = 'test.test', $data = null, $token = null) {
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); 
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POST, 1);
        if( !empty($data) )
        {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            $header = [];
            $header[] = 'Content-Type: application/json';
            $header[] = 'Content-Length: '.strlen(json_encode($data));
            if( $token !== null )
            {
                $header[] = 'Authorization: Bearer ' . $token;
            }
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        $result = curl_exec($curl);
        $headers = curl_getinfo($curl);
        curl_close($curl);
        $result = json_decode($result);
        return $result;
    }

    function ajax_contact_form() {
        if( isset($_POST) ) {
            $client_name = $_POST['name'];
            $client_lastname = $_POST['lastname'];
            $client_tel = $_POST['tel'];
            $client_email = $_POST['email'];
            $client_type = $_POST['type'];
            $client_message = $_POST['message'];
            $client_newsletter = $_POST['newsletter'];
            $post_title = 'Bewerbungen über das Kontaktformular unter: '.date('d/m/Y G:i');

            $response = array();

            if(get_field('from_emails','options')) {
				$to = get_field('from_emails','options');
			} else {
				$to = get_option('admin_email');
			}
			
			$message = '';
			$site_base = site_url();
			$site_base = preg_replace('#^https?://#', '', $site_base);
			$from = 'noreply@'.$site_base;
						
			$subject = 'Bewerbung über Kontaktformular';
			$sender = 'From: Gartenpark <'.$from.'>' . "\r\n";
				
			$message.='<p><b>Nahname: </b> '. $client_name .'</p>';
			$message.='<p><b>VorName: </b> '. $client_lastname .'</p>';
			$message.='<p><b>Tel. : </b> '. $client_tel  .'</p>';
			$message.='<p><b>E-mail: </b> '. $client_email .'</p>';
			$message.='<p><b>Type: </b> '. $client_type .'</p>';
                
            if( $_POST['message'] ) {
				$message.='<p><b>Message: </b> '. $client_message .'</p>';
			}
			
			$headers[] = 'MIME-Version: 1.0' . "\r\n";
			$headers[] = 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$headers[] = "X-Mailer: PHP \r\n";
			$headers[] = $sender;
							
            $mail = wp_mail( $to, $subject, $message, $headers );

            if( $client_newsletter == 'checked' ) {
                $specialErrors = array();
                
                $data = (object)[
                    'api' => 'https://rest.cleverreach.com/v2/',
                    'email' => $client_email,
                    'group_id' => 1096365,
                    'client_id' => 268370,
                    'username' => 'sergej@impltech.com',
                    'password' => 'rUgswToC',
                    'token' => null,
                    'source' => 'from.test',
                    'global_attributes' => null
                ];
                

                $data->global_attributes = [
                    'Vorname' => $client_name,
                    'Nachname' => $client_lastname,
                    'Tel.' => $client_tel
                ];

                
                $responsePost = curl_post(
                    $data->api.'login.json',
                     [
                    'client_id' => $data->client_id,
                    'login' => $data->username,
                    'password' => $data->password
                ]);
                
                if( isset($responsePost->error) ) { 
                    $specialErrors['error'] = 'error in retrive access token'; 
                }
                
                $data->token = $responsePost;
                
                /* add recipient (unverified) */
                $responsePost = curl_post($data->api.'groups.json/'.$data->group_id.'/receivers', [
                    'email' => $data->email,
                    'registered' => time(),
                    'activated' => 1,
                    'source' => $data->source,
                    'global_attributes' => $data->global_attributes
                ], $data->token);
                
                if( isset($responsePost->error) ) { 
                    $specialErrors['error'] = 'error in retrive insert recipeties'; 
                }			
            }
            
            $application_data = array(
                'post_title' => $post_title,
                'post_status' => 'publish',
                'post_type' => 'application',
                'post_author' => get_current_user_id()
            );

            $new_post = wp_insert_post($application_data, true);
            if( !is_wp_error($new_post) ) {
                update_field('client_name', $client_name, $new_post);
                update_field('client_lastname', $client_lastname, $new_post);
                update_field('client_tel', $client_tel, $new_post);
                update_field('client_email', $client_email, $new_post);
                update_field('client_type', $client_type, $new_post);
                update_field('client_message', $client_message, $new_post);
            };
            
				
			if( $mail and !is_wp_error($new_post) ) {
				$response['response'] = 'SUCCESS';
				$response['clever_reach'] = json_encode($specialErrors);
			} else {
				$response['response'] = 'ERROR';
				$response['error'] = $mail.'---'.$new_post.'---'.json_encode($specialErrors);
			}
			
            echo json_encode( $response );
        }

        die();
    }
}