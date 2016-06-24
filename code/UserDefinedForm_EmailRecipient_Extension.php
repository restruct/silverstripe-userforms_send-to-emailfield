<?php

class UserDefinedForm_EmailRecipient_Extension extends DataExtension
{

    /**
     * @config replace fields dropdown with juse fields of type Emailfield (default)
     * (alternative/false: add EmailFields to whatever the UserForms module may have decided to show as fields an e-mail can be sent to)
     */
    private static $replace_existing = false;

    public function nonProtectedGetFormParent()
    {
        $formID = $this->owner->FormID
            ? $this->owner->FormID
            : Session::get('CMSMain.currentPage');
        return UserDefinedForm::get()->byID($formID);
    }

    public function updateCMSFields(FieldList $fields)
    {

        $form = $this->nonProtectedGetFormParent();

        // add back email fields to send a confirmation to
        $extraEmailFromFields = EditableEmailField::get()->filter('ParentID', $form->ID);
        $source = $fields->dataFieldByName('SendEmailToFieldID')->getSource();
        // replace or add...
        if(Config::inst()->get(get_class(), 'replace_existing')) {
            $fields->dataFieldByName('SendEmailToFieldID')
                ->setSource($extraEmailFromFields->map('ID', 'Title')->toArray())
                ->setEmptyString(''); // allow empty
        } else {
            foreach ($extraEmailFromFields->map('ID', 'Title')->toArray() as $key => $val) {
                if (!$source->offsetExists($key)) {
                    $source->unshift($key, $val);
                }
            }
            $fields->dataFieldByName('SendEmailToFieldID')
                ->setSource($source)
                ->setEmptyString(''); // allow empty
        }
    }

}
