<?php
require '/srv/http/vendor/autoload.php';
require_once '/srv/http/helpers/sendEmail.php';
if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Gmail API PHP Quickstart');
    $client->setScopes('https://mail.google.com');
    $client->setAuthConfig('/srv/http/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = '/srv/http/token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Gmail($client);
function sendGmailEmail($message, $subject, $functionUsername, $functionEmail, $time, $functionService)
{
    if (time() >= $time) {
        $strRawMessage = "From: Justus Croskery<justus@olmmcc.tk>\r\n";
        $strRawMessage .= ("To: " . $functionUsername . "<" . $functionEmail . ">\r\n");
        $strRawMessage .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
        $strRawMessage .= "MIME-Version: 1.0\r\n";
        $strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
        $strRawMessage .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
        $strRawMessage .= $message;
        $user = 'me';
        $mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
        $msg = new Google_Service_Gmail_Message();
        $msg->setRaw($mime);
        try {
            $functionService->users_messages->send('me', $msg);
            echo "Email sent";
        } catch (Exception $e){
            getEmail('Email address invalid', $functionEmail, $functionUsername, $functionEmail);
            echo "Email address invalid";
        }
        
    }
}
$list = $service->users_messages->listUsersMessages('me', ['maxResults' => 9999, 'labelIds' => 'INBOX']);
$files = scandir('/srv/http/json/outgoing/');
foreach ($files as $file) {
    $regex = "/(.*)\.json/";
    if (preg_match($regex, $file)) {
        $data = json_decode(file_get_contents('/srv/http/json/outgoing/' . $file), true);
        sendGmailEmail($data['message'], $data['subject'], $data['username'], $data['email'], $data['time'], $service);
        unlink('/srv/http/json/outgoing/' . $file);
    }
}
$first = true;
foreach ($list->getMessages() as $mlist) {
    if ($first) {
        $message_id = $mlist->id;
        $message = getMessage($service, 'me', $message_id);
        $position = stripos($message, "Your message wasn't delivered to ");
        if ($position !== false) {
            $substr = substr($message, $position + 33, 255);
            $errorEmail = explode(' ', trim($substr))[0];
            if ($errorEmail != '') {
                getEmail('Email does not exist', $errorEmail, $errorEmail, 'mailer-daemon@googlemail.com');
                echo 'deleted email';
                $service->users_messages->delete('me', $message_id);
            }
        }
    }

}
function getMessage($service, $userId, $messageId)
{
    try {
        $message = $service->users_messages->get($userId, $messageId, ['format' => 'raw']);

        $message = str_replace(['-', '_'], ['+', '/'], $message->raw);
        $message = base64_decode($message);

        return $message;
    } catch (Exception $e) {
        print 'An error occurred: ' . $e->getMessage();
    }
}
