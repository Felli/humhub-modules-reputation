<?php

namespace humhub\modules\reputation\widgets;

use humhub\modules\content\widgets\Stream;

class ReputationStream extends Stream {

    public function init() {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    protected function getStreamUrl() {
        $params = array_merge([
            'limit' => '-limit-',
            'filters' => '-filter-',
            'sort' => '-sort-',
            'from' => '-from-',
            'mode' => \humhub\modules\reputation\components\StreamAction::MODE_HOT
                ], $this->streamActionParams);

        if ($this->contentContainer) {
            return $this->contentContainer->createUrl($this->streamAction, $params);
        } else {
            array_unshift($params, $this->streamAction);
            return Url::to($params);
        }
    }

    public function run() {
        return $this->render('stream', ['streamUrl' => $this->getStreamUrl(), 'showFilters' => $this->showFilters, 'filters' => $this->filters]);
    }

}
