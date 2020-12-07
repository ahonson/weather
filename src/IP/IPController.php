<?php

namespace Anax\Controller;

namespace artes\IP;

// use Anax\Commons\AppInjectableInterface;
// use Anax\Commons\AppInjectableTrait;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD)
 */
class IPController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function initAction() : object
    {
        $response = $this->di->get("response");
        $session = $this->di->get("session");
        $session->set("userip", null);
        return $response->redirect("ip");
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $ipkey = "";
        // this loads $ipkey and $weatherkey
        include(ANAX_INSTALL_PATH . '/config/api/apikeys.php');
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $realip = new RealIP();
        $ipaddress = $realip->getRealIpAddr();
        $input = $session->get("userip") ? $session->get("userip") : "";

        $userip = new IPCheck($input);
        $ipmsg = $userip->printAllMessages();
        $inputgeotag = new IPGeotag($ipkey);
        $inputgeoinfo = $inputgeotag->checkinputip($input);
        $iptotest = $input ? $input : $ipaddress;
        $usergeoinfo = $inputgeotag->checkdefaultip($iptotest);

        $data = [
            "usergeoinfo" => $usergeoinfo,
            "inputgeoinfo" => $inputgeoinfo,
            "ipmsg" => $ipmsg
        ];

        $page->add(
            "ip/index",
            $data
        );

        return $page->render([
            "title" => "My IP",
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionPost() : object
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $session = $this->di->get("session");

        $userip = $request->getPost("userip");
        $session->set("userip", $userip);

        return $response->redirect("ip");
    }
}
