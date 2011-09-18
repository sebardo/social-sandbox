Social Sandbox
========================

Welcome to the Social Sandbox Edition - a fully-functional Symfony 1.4
application that you can use as core for your new social network. If you want
to learn more about the features included, see the "What's inside?" section.

1) Download the Social Sandbox
--------------------------------

If you've already downloaded the Social Sandbox, and unpacked it somewhere
within your web root directory, then move on to the "Installation" section.

To download the Social Sandbox, you have two options:

### Download an archive file (*recommended*)

The easiest way to get started is to download an archive of the standard edition
(https://sebardo@github.com/sebardo/social-sandbox.git). Unpack it somewhere under your web server root
directory and you're done. The web root is wherever your web server (e.g. Apache)
looks when you access `http://localhost` in a browser.

### Clone the git Repository

We highly recommend that you download the packaged version of this distribution.
But if you still want to use Git, you are on your own.

Run the following commands:

    git clone git://github.com/sebardo/social-sandbox.git
    cd social-sandbox


2) Installation
---------------

2.1 - With the virtual host set up, configure the app to the applications, in this scenario the virtual host is called http://social-sandbox:
  
    app/frontend/config/app.yml
    app/backend/config/app.yml

2.2 - Set the database in this scenario is called test
    
    all:
      doctrine:
        class: sfDoctrineDatabase
        param:
          dsn: mysql:host=localhost;dbname=test
          username: root
          password:

2.3 - Run the following commands:
    
    doctrine:buil --all --no-confirmation
 
and 
    
    plugin:publish-assets 

2.4 - Create the admin user:
    
    guard:create-user dsastu@gmail.com admin 111111
    guard:promote admin

2.5-Insert some settings for sending mails:

    INSERT INTO `setting` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
    (1, 'Messages', 'I sent a direct message', 1, '0000-00-00 00:00:00 ', '0000-00-00 00:00:00'),
    (2, 'Activities', 'Someone has followed me again', 1, '0000-00-00 00:00:00 ', '0000-00-00 00:00:00'),
    (3, 'Comments', 'When is someone to comment on publications', 1, '0000-00-00 00:00:00 ', '0000-00-00 00:00:00'),
    (4, 'Activities', 'When someone like some of my photos, audio or publicacions.', 1, '0000-00-00 00:00:00 ', '0000-00-00 00:00:00' );

2.6 - Purchase a key to the app.yml GMaps and place of EventPlugin.

2.7 - To verify that the network is installed and ready to extenderce according usuarce and objectives, your browser put the url of the host.

    http://social-sandbox

What's inside?
---------------
The Social Sandbox Edition comes pre-configured with the following plugins:
	
* **PubsPlugin** - The core Social Sandbox plugin
* **InboxPlugin** - Adds private messages
* **EventPlugin** - Adds events plugin
* **PluginPlugin** - Adds photos plugin
* **sfDoctrineGuardPlugin** - Modified plugin
* **sfFormExtraPlugin** - Dependent plugin
* **sfThumbnailPlugin** - Dependent plugin


Any questions do not hesitate to contact me to dsastu@gmail.com

Se vemos 

Enjoy!
