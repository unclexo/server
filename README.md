Resource Server API
-------------------

**server** is a RESTful application. This works as the Resource Server and the Authorization Server from the same API server. So this would be both your resource server and authorization server. **server** uses OAuth2 authentication framework to authenticate resource owner using password grant.

**Caution:** This is designed to work with this repo <a href="https://github.com/unclexo/client">client</a> which would be a Client of this API. So this must be ready too!

Installation
------------

Just clone the repository and run `composer` as follows:

```bash
cd path/to/project/dir
git clone git://github.com/unclexo/server.git
cd server
php composer.phar install
```

Alternately, download the repo to some directory and run `composer` as follows:

```bash
cd path/to/project/dir
php composer.phar install
```

Web Server Setup
----------------

### Apache Setup

To setup apache, setup a virtual host to point to the public/ directory of the
project. It should look something like below:

```
<VirtualHost *:80>
  ServerName server.dev
  DocumentRoot /path/to/server/public
  <Directory /path/to/server/public>
    DirectoryIndex index.php
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
```

Database Setup
--------------

### Database config:

**server** expects and assumes you have a valid database configuration under a top key named `db`.

### Database tables:

Database tables are shipped with this repo in the `data` folder. Otherwise, you may get the sql file from <a href="https://github.com/unclexo/client/blob/master/data/server-db.sql">here</a>.

What More Needs to Be Done
--------------------------

You must set up another repo to work with this API as a Client API named <a href="https://github.com/unclexo/client">client</a>. So please <a href="https://github.com/unclexo/client">go over there</a> and set up things as said there.

### Modification for client repo: 

As you already know it works with this repo <a href="https://github.com/unclexo/client">client</a>

So this <a href="https://github.com/unclexo/client">client</a> repo expects server name as `server.dev`.

If you do not set up the `ServerName` to `server.dev` while creating virtual host, you have to change your preferred server name only in two places in two files of this <a href="https://github.com/unclexo/client">client</a> repo. So please search for `server.dev` in the following files and replace them with your own one:

```
client/module/Common/src/Common/Client/ApiClient.php
client/module/User/src/User/Entity/UserEntity.php
```

License
-------

**server** is provided under the MIT license.


Contributing
------------

If you found a mistake or a bug, please report it using the <a href="https://github.com/unclexo/server/issues">Issues</a> page. Your feedback is highly appreciated.