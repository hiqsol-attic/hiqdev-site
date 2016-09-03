<?php

namespace hiqdev\site\controllers;

use cebe\markdown\GithubMarkdown;

class SiteController extends \hisite\controllers\SiteController
{

    public function actionPages()
    {
        $parser = new GithubMarkdown();
        
        return $parser->parse('@hiqdev/site/README.md');
    }
}
