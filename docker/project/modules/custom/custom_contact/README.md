# Use the following code to try it out
``php
private function sendEmail(string $to) {
    $params = [];
    $params['message'] = 'Mail Body';
    $params['subject'] = 'Sample Subject';

    //Calling drupal Mail service
    $mailManager = \Drupal::service('plugin.manager.mail');
    //Module Name
    $module = 'custom_mail_sending';
    //Static Mail Key
    $key = 'custom_mail_sending_key';
    //Email Language
    $langcode = \Drupal::currentUser()->getPreferredLangcode();
    $send = true;

    $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
    if ($result['result'] != true) {
      $message = t('There was a problem sending your email notification to @email.', array('@email' => $result["to"]));
      drupal_set_message($message, 'error');
      \Drupal::logger('custom_mail_sending_log')->notice($message);
    } else {
      $message = t('An email notification has been sent to @email ', array('@email' => $to));
      drupal_set_message($message,'status');
      \Drupal::logger('custom_mail_sending_log')->error($message);
    }
  }
  ``
