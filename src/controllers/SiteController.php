<?php

namespace hiqdev\site\controllers;

use cebe\markdown\GithubMarkdown;
use Symfony\Component\Yaml\Yaml;
use Yii;

class SiteController extends \hisite\controllers\SiteController
{

    public function actionPages($page = null)
    {
        $parser = new GithubMarkdown();
        $path = Yii::getAlias('@hiqdev/site/pages/' . $page . '.md');
        if (!file_exists($path)) {
            die($path);
        }

        return $this->renderMarkdown($path);
    }

    public function renderMarkdown($path)
    {
        $lines = file($path);
        list($data, $md) = $this->extractData($lines);

#var_dump(compact('data', 'md')); die();

        $data['html'] = $parser->parse($md);

        return $this->render('pages', $data);
    }

    public function extractData(array $lines)
    {
        $marker = "---\n";
        $line = array_shift($lines);
        if ($line === $marker) {
            $meta = '';
            while (true) {
                $line = array_shift($lines);
                if ($line === $marker) {
                    break;
                }
                $meta .= $line;
            }
            $line = '';
            $data = Yaml::parse($meta);
        } else {
            $data = [];
        }

        return [[], $line . join("\n", $lines)];
    }
}
