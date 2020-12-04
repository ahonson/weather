<?php

namespace artes\IP;


/**
 * Class for mocking IPController
 * @SuppressWarnings(PHPMD)
 */
class IPControllerMock extends IPController
{
    /**
    *
    * @return object
    */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $usergeoinfo = [
            "ip" => "8.8.8.8"
        ];
        $data = [
            "usergeoinfo" => $usergeoinfo,
            "inputgeoinfo" => "mock info",
            "ipmsg" => "mock message"
        ];
        $page->add(
            "ip/index",
            $data
        );

        // die("vavavava");
        return $page->render([
            "title" => "My IP",
        ]);
    }
}
