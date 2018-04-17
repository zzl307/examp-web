<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Curl\Curl;

class IndexController extends Controller
{	
	// 后台首页
	public function home()
	{	
		if (request()->isMethod('POST')) {
			$data = request()->input('key');

            if (empty($data)) {
                $data = 'http://127.0.0.1';
            }

			request()->session()->regenerate();
			request()->session()->forget('userList');
			request()->session()->forget('systemConfig');
			request()->session()->forget('systemConfigPost');
			request()->session()->forget('key');

			$userCurl = new Curl();
			$userListUrl = $data.'/examp/api/clients';
			$userCurl->get($userListUrl);
			if (is_object($userCurl->response)) {
				$userList = isset($userCurl->response->data) ? $userCurl->response->data : '';
				request()->session()->put('userList', $userList);
				request()->session()->put('key', $data);

				$systemCurl = new Curl();
				$systemUrl = $data.'/examp/api/config';
				$systemCurl->get($systemUrl);
				if (is_object($systemCurl->response)) {
					if (isset($systemCurl->response->data)) {
						$systemConfig = json_decode(json_encode($systemCurl->response->data), true);
						request()->session()->put('systemConfig', $systemConfig);
					}
					
				}

				return redirect('userList');
			}
		}

		return View('index');
	}

    // 终端信息
    public function userList()
    {	
		$userList = request()->session()->get('userList');

		return View('userList', compact('userList'));
    }

    // 终端删除
    public function getLogout()
    {
    	if (request()->session()->has('userList')) {
    		$client = request()->input('ip');
    		$curl = new Curl();
			$url = request()->session()->get('key').'/examp/api/logout';
			$curl->post($url, array(
				'client' => $client
			));
			
			return $curl->response->errcode;
    	}
    }

    // 终端信息刷新
    public function userListRefresh()
    {
    	request()->session()->regenerate();
		request()->session()->forget('userList');
		$userCurl = new Curl();
		$userListUrl = request()->session()->get('key').'/examp/api/clients';
		$userCurl->get($userListUrl);
		if (is_object($userCurl->response)) {
			$userList = isset($userCurl->response->data) ? $userCurl->response->data : '';
			request()->session()->put('userList', $userList);

			return redirect('userList');
		}
    }

    public function getUserListLogout()
    {
    	request()->session()->regenerate();
		request()->session()->forget('userList');

		$curl = new Curl();
		$url = request()->session()->get('key').'/examp/api/clients';
		$curl->get($url);
		if (is_object($curl->response)) {
			$userList = isset($curl->response->data) ? $curl->response->data : '';
			request()->session()->put('userList', $userList);
			
			return redirect('userList');
		}
    }

    // 系统配置
    public function system()
    {	
    	if (request()->session()->has('systemConfigPost')) {
    		$systemConfig = request()->session()->get('systemConfigPost');
    	} else {
    		$systemConfig = request()->session()->get('systemConfig');
    	}

        $data['device'] = 'device';

		return View('system', compact('systemConfig', 'data'));
    }

    // 修改数据镜像接口
    public function mirror()
    {
    	if (request()->isMethod('POST')) {
    		$data = request()->input('mirror');

    		if (request()->session()->has('systemConfigPost')) {
    			$systemConfigPost = request()->session()->get('systemConfigPost');
    			$systemConfigPost['mirror-device'] = $data['mirror-device'];
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		} else {
    			$systemConfigPost = request()->session()->get('systemConfig');
    			$systemConfigPost['mirror-device'] = $data['mirror-device'];
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		}
    		$systemConfig = request()->session()->get('systemConfigPost');

            $data['device'] = 'device';

    		return View('system', compact('systemConfig', 'data'));
    	}
    }

    // 修改数据发送接口
   	public function mirrorPost()
   	{	
   		if (request()->isMethod('POST')) {
    		$data = request()->input('mirror');

    		if (request()->session()->has('systemConfigPost')) {
    			$systemConfigPost = request()->session()->get('systemConfigPost');
    			$systemConfigPost['write-device'] = $data['write-device'];
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		} else {
    			$systemConfigPost = request()->session()->get('systemConfig');
    			$systemConfigPost['write-device'] = $data['write-device'];
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		}
    		$systemConfig = request()->session()->get('systemConfigPost');

            $data['device'] = 'device';

    		return View('system', compact('systemConfig', 'data'));
    	}
   	}

    // 添加radius
    public function radius()
    {	
    	$radius = request()->input('radius');
    	$radius['port'] = (int)$radius['port'];
    	$radius['acctport'] = (int)$radius['acctport'];
    	if (request()->session()->has('systemConfigPost')) {
    		$system_config = request()->session()->get('systemConfigPost');
    		if (isset($system_config['radius'])) {
    			array_push($system_config['radius'], $radius);
    		} else {
    			$system_config['radius'][] = $radius;
    		}
    		request()->session()->put('systemConfigPost', $system_config);
    	} else {
    		$system_config = request()->session()->get('systemConfig');
    		if (isset($system_config['radius'])) {
    			array_push($system_config['radius'], $radius);
    		} else {
    			$system_config['radius'][] = $radius;
    		}
    		request()->session()->put('systemConfigPost', $system_config);
    	}
    	$systemConfig = request()->session()->get('systemConfigPost');

    	$data['radius'] = 'radius';

    	return View('system', compact('systemConfig', 'data'));
    }

    // 修改radius
    public function radiusEdit()
    {
    	if (request()->isMethod('POST')) {
    		$data = request()->input('radius');
    		$id = request()->input('id');
    		$data['port'] = (int)$data['port'];
    		$data['acctport'] = (int)$data['acctport'];

    		if (request()->session()->has('systemConfigPost')) {
    			$systemConfigPost = request()->session()->get('systemConfigPost');
    			$systemConfigPost['radius'][$id] = $data;
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		} else {
    			$systemConfigPost = request()->session()->get('systemConfig');
    			$systemConfigPost['radius'][$id] = $data;
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		}
    		$systemConfig = request()->session()->get('systemConfigPost');

            $data['radius'] = 'radius';

    		return View('system', compact('systemConfig', 'data'));
    	}
    }

    // 删除radius
    public function radiusDelete($id)
    {	
    	if (request()->session()->has('systemConfigPost')) {
    		$systemConfigPost = request()->session()->get('systemConfigPost');
    		array_splice($systemConfigPost['radius'], $id, 1);
    		request()->session()->put('systemConfigPost', $systemConfigPost);
    	} else {
    		$systemConfigPost = request()->session()->get('systemConfig');
    		array_splice($systemConfigPost['radius'], $id, 1);
    		request()->session()->put('systemConfigPost', $systemConfigPost);
    	}
    	$systemConfig = request()->session()->get('systemConfigPost');

        $data['radius'] = 'radius';

    	return View('system', compact('systemConfig', 'data'));
    }

    // 添加Portal
    public function portal()
    {	
    	$portal = request()->input('portal');
    	$portal['radius-acct-interval'] = (int)$portal['radius-acct-interval'];
    	$portal['idle-timeout'] = (int)$portal['idle-timeout'];
    	$portal['session-timeout'] = (int)$portal['session-timeout'];
    	$portal['mac-auth'] = (int)$portal['mac-auth'];
    	if (request()->session()->has('systemConfigPost')) {
    		$system_config = request()->session()->get('systemConfigPost');
    		if (isset($system_config['hotspot'])) {
    			array_push($system_config['hotspot'], $portal);
    		} else {
    			$system_config['hotspot'][] = $portal;
    		}
    		request()->session()->put('systemConfigPost', $system_config);
    	} else {
    		$system_config = request()->session()->get('systemConfig');
    		if (isset($system_config['hotspot'])) {
    			array_push($system_config['hotspot'], $portal);
    		} else {
    			$system_config['hotspot'][] = $portal;
    		}
    		request()->session()->put('systemConfigPost', $system_config);
    	}
    	$systemConfig = request()->session()->get('systemConfigPost');

        $data['portal'] = 'portal';

    	return View('system', compact('systemConfig', 'data'));
    }

    // 修改Portal
    public function portalEdit()
    {
    	if (request()->isMethod('POST')) {
    		$portal = request()->input('portal');
    		$id = request()->input('id');
    		$portal['radius-acct-interval'] = (int)$portal['radius-acct-interval'];
	    	$portal['idle-timeout'] = (int)$portal['idle-timeout'];
	    	$portal['session-timeout'] = (int)$portal['session-timeout'];
	    	$portal['mac-auth'] = (int)$portal['mac-auth'];

    		if (request()->session()->has('systemConfigPost')) {
    			$systemConfigPost = request()->session()->get('systemConfigPost');
    			$systemConfigPost['hotspot'][$id] = $portal;
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		} else {
    			$systemConfigPost = request()->session()->get('systemConfig');
    			$systemConfigPost['hotspot'][$id] = $portal;
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		}
    		$systemConfig = request()->session()->get('systemConfigPost');

            $data['portal'] = 'portal';

    		return View('system', compact('systemConfig', 'data'));
    	}
    }

    // 删除Portal
    public function portalDelete($id)
    {	
    	if (request()->session()->has('systemConfigPost')) {
    		$systemConfigPost = request()->session()->get('systemConfigPost');
    		array_splice($systemConfigPost['hotspot'], $id, 1);
    		request()->session()->put('systemConfigPost', $systemConfigPost);
    	} else {
    		$systemConfigPost = request()->session()->get('systemConfig');
    		array_splice($systemConfigPost['hotspot'], $id, 1);
    		request()->session()->put('systemConfigPost', $systemConfigPost);
    	}
    	$systemConfig = request()->session()->get('systemConfigPost');

        $data['portal'] = 'portal';

    	return View('system', compact('systemConfig', 'data'));
    }

    // 修改hotspot-profile
    public function hotspotProfile()
    {
    	if (request()->isMethod('POST')) {
    		$profile = request()->input('profile');

    		if (request()->session()->has('systemConfigPost')) {
    			$systemConfigPost = request()->session()->get('systemConfigPost');
    			$systemConfigPost['hotspot-profile'] = $profile['profile'];
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		} else {
    			$systemConfigPost = request()->session()->get('systemConfig');
    			$systemConfigPost['hotspot-profile'] = $profile['profile'];
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		}
    		$systemConfig = request()->session()->get('systemConfigPost');

            $data['portal'] = 'portal';

    		return View('system', compact('systemConfig', 'data'));
    	}
    }

    // 添加服务器白名单
    public function servers()
    {
    	$servers = request()->input('servers');
        $servers_data = explode('/', $servers['ip-address']);
        $servers['ip-address'] = $servers_data[0];
        if (isset($servers_data[1])) {
            $servers['netmask'] = (int)$servers_data[1];
        } else {
            $servers['netmask'] = 32;
        }
        
    	if (request()->session()->has('systemConfigPost')) {
    		$system_config = request()->session()->get('systemConfigPost');
    		if (isset($system_config['whitelist-servers'])) {
				array_push($system_config['whitelist-servers'], $servers);
			} else {
				$system_config['whitelist-servers'][] = $servers;
			}
    		request()->session()->put('systemConfigPost', $system_config);
    	} else {
    		$system_config = request()->session()->get('systemConfig');
    		if (isset($system_config['whitelist-servers'])) {
				array_push($system_config['whitelist-servers'], $servers);
			} else {
				$system_config['whitelist-servers'][] = $servers;
			}
    		request()->session()->put('systemConfigPost', $system_config);
    	}
    	$systemConfig = request()->session()->get('systemConfigPost');

        $data['whitelist_update'] = 'whitelist_update';

    	return View('system', compact('systemConfig', 'data'));
    }

    // 修改服务器白名单
    public function serversEdit()
    {
    	if (request()->isMethod('POST')) {
    		$servers = request()->input('servers');
    		$id = request()->input('id');
            $servers_data = explode('/', $servers['ip-address']);
            $servers['ip-address'] = $servers_data[0];
            if (isset($servers_data[1])) {
                $servers['netmask'] = (int)$servers_data[1];
            } else {
                $servers['netmask'] = 32;
            }

    		if (request()->session()->has('systemConfigPost')) {
    			$systemConfigPost = request()->session()->get('systemConfigPost');
    			$systemConfigPost['whitelist-servers'][$id] = $servers;
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		} else {
    			$systemConfigPost = request()->session()->get('systemConfig');
    			$systemConfigPost['whitelist-servers'][$id] = $servers;
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		}
    		$systemConfig = request()->session()->get('systemConfigPost');

            $data['whitelist_update'] = 'whitelist_update';

    		return View('system', compact('systemConfig', 'data'));
    	}
    }

    // 删除服务器白名单
    public function serversDelete($id)
    {
    	if (request()->session()->has('systemConfigPost')) {
    		$systemConfigPost = request()->session()->get('systemConfigPost');
    		array_splice($systemConfigPost['whitelist-servers'], $id, 1);
    		request()->session()->put('systemConfigPost', $systemConfigPost);
    	} else {
    		$systemConfigPost = request()->session()->get('systemConfig');
    		array_splice($systemConfigPost['whitelist-servers'], $id, 1);
    		request()->session()->put('systemConfigPost', $systemConfigPost);
    	}
    	$systemConfig = request()->session()->get('systemConfigPost');

        $data['whitelist_update'] = 'whitelist_update';

    	return View('system', compact('systemConfig', 'data'));
    }
	    
    // 添加终端白名单
    public function clients()
    {
    	$clients = request()->input('clients');
        $clients_data = explode('/', $clients['ip-address']);
        $clients['ip-address'] = $clients_data[0];
        if (isset($clients_data[1])) {
            $clients['netmask'] = (int)$clients_data[1];
        } else {
            $clients['netmask'] = 32;
        }
    	
    	if (request()->session()->has('systemConfigPost')) {
    		$system_config = request()->session()->get('systemConfigPost');
    		if (isset($system_config['whitelist-clients'])) {
				array_push($system_config['whitelist-clients'], $clients);
			} else {
				$system_config['whitelist-clients'][] = $clients;
			}
    		request()->session()->put('systemConfigPost', $system_config);
    	} else {
    		$system_config = request()->session()->get('systemConfig');
    		if (isset($system_config['whitelist-clients'])) {
				array_push($system_config['whitelist-clients'], $clients);
			} else {
				$system_config['whitelist-clients'][] = $clients;
			}
    		request()->session()->put('systemConfigPost', $system_config);
    	}
    	$systemConfig = request()->session()->get('systemConfigPost');

        $data['whitelist_update'] = 'whitelist_update';

    	return View('system', compact('systemConfig', 'data'));
    }

    // 修改终端白名单
    public function clientsEdit()
    {
    	if (request()->isMethod('POST')) {
    		$clients = request()->input('clients');
    		$id = request()->input('id');
    		$clients_data = explode('/', $clients['ip-address']);
            $clients['ip-address'] = $clients_data[0];
            if (isset($clients_data[1])) {
                $clients['netmask'] = (int)$clients_data[1];
            } else {
                $clients['netmask'] = 32;
            }

    		if (request()->session()->has('systemConfigPost')) {
    			$systemConfigPost = request()->session()->get('systemConfigPost');
    			$systemConfigPost['whitelist-clients'][$id] = $clients;
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		} else {
    			$systemConfigPost = request()->session()->get('systemConfig');
    			$systemConfigPost['whitelist-clients'][$id] = $clients;
    			request()->session()->put('systemConfigPost', $systemConfigPost);
    		}
    		$systemConfig = request()->session()->get('systemConfigPost');

            $data['whitelist_update'] = 'whitelist_update';

    		return View('system', compact('systemConfig', 'data'));
    	}
    }

    // 删除终端白名单
    public function clientsDelete($id)
    {
    	if (request()->session()->has('systemConfigPost')) {
    		$systemConfigPost = request()->session()->get('systemConfigPost');
    		array_splice($systemConfigPost['whitelist-clients'], $id, 1);
    		request()->session()->put('systemConfigPost', $systemConfigPost);
    	} else {
    		$systemConfigPost = request()->session()->get('systemConfig');
    		array_splice($systemConfigPost['whitelist-clients'], $id, 1);
    		request()->session()->put('systemConfigPost', $systemConfigPost);
    	}
    	$systemConfig = request()->session()->get('systemConfigPost');

        $data['whitelist_update'] = 'whitelist_update';

    	return View('system', compact('systemConfig', 'data'));
    }

    // 添加网络黑名单
    public function blackList()
    {
        $blackList = request()->input('blackList');
        
        if (request()->session()->has('systemConfigPost')) {
            $system_config = request()->session()->get('systemConfigPost');
            if (isset($system_config['blacklist'])) {
                array_push($system_config['blacklist'], $blackList['ip-address']);
            } else {
                $system_config['blacklist'][] = $blackList['ip-address'];
            }
            request()->session()->put('systemConfigPost', $system_config);
        } else {
            $system_config = request()->session()->get('systemConfig');
            if (isset($system_config['blacklist'])) {
                array_push($system_config['blacklist'], $blackList['ip-address']);
            } else {
                $system_config['blacklist'][] = $blackList['ip-address'];
            }
            request()->session()->put('systemConfigPost', $system_config);
        }
        $systemConfig = request()->session()->get('systemConfigPost');

        $data['whitelist_update'] = 'whitelist_update';

        return View('system', compact('systemConfig', 'data'));
    }

    // 修改网络黑名单
    public function blackListEdit()
    {
        if (request()->isMethod('POST')) {
            $blackList = request()->input('blackList');
            $id = request()->input('id');

            if (request()->session()->has('systemConfigPost')) {
                $systemConfigPost = request()->session()->get('systemConfigPost');
                $systemConfigPost['blacklist'][$id] = $blackList['ip-address'];
                request()->session()->put('systemConfigPost', $systemConfigPost);
            } else {
                $systemConfigPost = request()->session()->get('systemConfig');
                $systemConfigPost['blacklist'][$id] = $blackList['ip-address'];
                request()->session()->put('systemConfigPost', $systemConfigPost);
            }
            $systemConfig = request()->session()->get('systemConfigPost');

            $data['whitelist_update'] = 'whitelist_update';

            return View('system', compact('systemConfig', 'data'));
        }
    }

    // 删除网络黑名单
    public function blackListDelete($id)
    {
        if (request()->session()->has('systemConfigPost')) {
            $systemConfigPost = request()->session()->get('systemConfigPost');
            array_splice($systemConfigPost['blacklist'], $id, 1);
            request()->session()->put('systemConfigPost', $systemConfigPost);
        } else {
            $systemConfigPost = request()->session()->get('systemConfig');
            array_splice($systemConfigPost['blacklist'], $id, 1);
            request()->session()->put('systemConfigPost', $systemConfigPost);
        }
        $systemConfig = request()->session()->get('systemConfigPost');

        $data['whitelist_update'] = 'whitelist_update';

        return View('system', compact('systemConfig', 'data'));
    }

    // 提交
    public function systemSubmit()
    {
    	if (request()->session()->has('systemConfigPost')) {
    		$system_config = request()->session()->get('systemConfigPost');
    		$curl = new Curl();
			$curl->setDefaultJsonDecoder($assoc = true);
			$curl->setHeader('Content-Type', 'application/json');
			$url = request()->session()->get('key').'/examp/api/config';
			$curl->post($url, $system_config);
			
			return $curl->response;
    	} else {
    		$system_config = request()->session()->get('systemConfig');
    		$curl = new Curl();
			$curl->setDefaultJsonDecoder($assoc = true);
			$curl->setHeader('Content-Type', 'application/json');
			$url = request()->session()->get('key').'/examp/api/config';
			$curl->post($url, $system_config);
			
			return $curl->response;
    	}
    }

    public function systemConfigSubmit()
    {
    	request()->session()->regenerate();
		request()->session()->forget('systemConfig');
		request()->session()->forget('systemConfigPost');

		$systemCurl = new Curl();
		$systemUrl = request()->session()->get('key').'/examp/api/config';
		$systemCurl->get($systemUrl);
		if (is_object($systemCurl->response)) {
			if (isset($systemCurl->response->data)) {
				$systemConfig = json_decode(json_encode($systemCurl->response->data), true);
				request()->session()->put('systemConfig', $systemConfig);
			}
			
			return redirect('system');
		}
    }

    // 系统配置刷新
    public function systemConfigRefresh()
    {
    	request()->session()->regenerate();
		request()->session()->forget('systemConfig');
		request()->session()->forget('systemConfigPost');
		$systemCurl = new Curl();
		$systemUrl = request()->session()->get('key').'/examp/api/config';
		$systemCurl->get($systemUrl);
		if (is_object($systemCurl->response)) {
			if (isset($systemCurl->response->data)) {
				$systemConfig = json_decode(json_encode($systemCurl->response->data), true);
				request()->session()->put('systemConfig', $systemConfig);
			}
			
			return redirect('system');
		}
    }
}
