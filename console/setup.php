<?php

echo "Création de la structure de base\n";

$source = __DIR__ . '/base_structure';
$dest = __DIR__ . '/../app';

if (!file_exists($dest)) {
    mkdir($dest, 0755, true);
    foreach (
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST) as $item
    ) {
        if ($item->isDir()) {
            mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
        } else {
            copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
        }
    }
}


echo "Tout est fait\n";