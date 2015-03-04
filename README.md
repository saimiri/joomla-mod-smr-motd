# Joomla! "Message of the Day" module

A simple module for displaying notices for your users in the administration section of your site.

By default displays the notices in the **message section** of the Control Panel using the message enqueue, unless the position is "login", in which case the message is displayed on the login page.

You can also choose to use any position available, but do take note that in practice any other location except for "cpanel" (which is **not** the message section but is only available on the Control Panel page) is very invasive, since you cannot select the page where modules are displayed in the backend.

Since the message enqueue doesn't currently support message titles, the notices shown in the message section of the Control Panel show only the default Joomla! titles ("notice", "warning" etc.).