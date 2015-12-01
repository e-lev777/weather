<?php
namespace Lib;

class Paginator
{
    public $prevButton = array('page'   => null,
                               'active' => false);
    public $nextButton = array('page'   => null,
                               'active' => false);
    public $buttons = array();

    public function __construct(array $params = array('currentPage'  => 1,
                                                      'itemsCount'   => 255,
                                                      'itemsPerPage' => 5))
    {
        $this->limit = $params['itemsPerPage'];
        extract($params);
        $pagesCount = ceil($itemsCount / $itemsPerPage);
        for($i = 1; $i <= $pagesCount; $i++){
            $active = $currentPage == $i ? false : true;
            $this->buttons[] = array('page'   => $i,
                                     'active' => $active);
            if( $currentPage == 1 ){
                $this->nextButton['active'] = true;
            } elseif ( $currentPage == $pagesCount ){
                $this->prevButton['active'] = true;
            } else {
                $this->nextButton['active'] = $this->prevButton['active'] = true;
            }
            $this->nextButton['page'] = $currentPage + 1;
            $this->prevButton['page'] = $currentPage - 1;
        }
    }
}