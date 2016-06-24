# Make user-filled EmailFields available as recipient to/reply-to address in UserForms

This module makes EmailFields defined in a userform available to select as To: or Reply-to: when defining recipients on the form. 
E.g. for sending out a simple "Thank you for your enquiry" reply.

## Installation

```sh
$ composer require micschk/silverstripe-userforms_send-to-emailfield dev-master
```

## Open-relay
This functionality was part of UserForms earlier but was removed because it creates a potential 'open relay' situation, 
e.g. a spammer could potentially craft requests to your form and make it send out e-mail confirmations to people/addresses 
that have not actually submitted your form. 

My personal opinion is that there are easier ways to get your spam e-mails out the door. And especially when not including any 
submitted data in the confirmation mails, it doesn't make much sense for a spammer to spend time on this. On the other hand, 
you never know what reasons anyone may have for still doing so. 

This situation (auto-sending confirmation mails) is however pretty common practice. Combined with SilverStripes form-session 
security, I think the benefits outweigh the potential for abuse. You may want to keep a log/tabs on it though.

Also see: https://github.com/silverstripe/silverstripe-userforms/issues/333#issuecomment-142324161
