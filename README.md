# Joomla! "Message of the Day" module

A simple module for displaying notices for your users in the administration section of your site.

You can choose to use any position available, but do take note that in practice any other location except for "cpanel" (which is **not** the message section but is only available on the Control Panel page) or "login" is very invasive, since you cannot select the page where modules are displayed in the backend.

If you choose to show the messages in the message section, then they are shown using the standard Joomla application message queue. Since the message enqueue doesn't currently support message titles, the notices shown in the message section of the Control Panel show only the default Joomla! titles ("notice", "warning" etc.).

## How to get nice looking messages

### From the module-specific settings

1. Leave **Show as a system message** to `No`
2. Leave **Heading level** to `4`
3. Leave **Show message heading** to `Yes`
4. Set **Message type** to any other except "None"

### From the common module settings

1. Set **Show title** to `Hide`
2. Set **Position** to either `cpanel` or `login` (these depend on the template used)
3. From the *Advanced* tab set **Module Style** to `none` (this will show only the message box without adding any template chrome around it)