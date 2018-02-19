# Architecture

```
.
├── App/
│   ├── models/
│   │   └── <models>
│   ├── controllers/
│   ├── views/
│   │   └── <controller>/
│   │       └── <action>.php
│   ├── config.php <-- tableau
│   └── www/ <-- publique
│       ├── index.php
│       └── <assets>
├── src/
│   ├── Router.php
│   ├── Model.php
│   ├── Controller.php
│   ├── Template.php
│   ├── Orm.php
│   ├── Log.php
│   └── Cache.php
├── vendor/
├── composer.json
└── composer.lock
```

# Tools

```
Hash::read($tableau, 'a.b'); // valeur ou null
$tableau = Hash:set($tableau, 'a.b.c.autre', 'nouvelle valeur');
$tableau = Hash::remove($tableau, 'a.b');
```
