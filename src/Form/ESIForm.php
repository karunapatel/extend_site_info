<?php

namespace Drupal\extend_site_info\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

class ESIForm extends SiteInformationForm {

   /**
    * {@inheritdoc}
    */
    public function buildForm(array $form, FormStateInterface $form_state) {
			$config = $this->config('system.site');
			$form =  parent::buildForm($form, $form_state);
			$form['site_information']['siteapikey'] = [
					'#type' => 'textfield',
					'#title' => t('Site API Key'),
					'#default_value' => $config->get('siteapikey') ?: 'No API Key yet',
					'#description' => t("Set the site API key here."),
			];
			return $form;
    }

	 /**
		* Configuration settings submit callback
		*/
		public function submitForm(array &$form, FormStateInterface $form_state) {
			$this->config('system.site')
				->set('siteapikey', $form_state->getValue('siteapikey'))
				->save();
			parent::submitForm($form, $form_state);
			drupal_set_message(t('Site API Key has been saved with "'.$form_state->getValue('siteapikey').'".'));
		}
}