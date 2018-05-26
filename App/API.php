<?php
/**
 * @author Sergey Zaharchenko <zaharchenko.dev@gmail.com>
 *
 * Endpoints:
 * export_api/v1/categories
 * export_api/v1/pages
 * export_api/v1/category/{category_number}/pages
 */

namespace Export_API;


/**
 * Class API
 * @package export_API
 */
class API
{
    /**
     * @var
     */
    private static $instance;

    /**
     * API constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return API
     */
    public static function instance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function response()
    {
        switch (mso_segment(3)) {
            case 'categories':
                $this->sendJson(mso_cat_array(), 200);
                break;
            case 'category':
                if (empty($categoryId = mso_segment(5)) || 'pages' !== mso_segment(6)) {
                    return false;
                }
	            $params = [
		            'date_now'    => false,
		            'categories'  => $categoryId,
		            'custom_type' => 'category',
		            'no_limit'    => true,
		            'work_cut'    => false,
		            'order_asc'   => 'asc',
	            ];

                $this->sendJson(mso_get_pages($params, $pag), 200);
                break;

	        case 'pages':
		        $params = [
			        'date_now'    => false,
			        'custom_type' => 'home',
			        'no_limit'    => true,
			        'work_cut'    => false,
			        'order_asc'   => 'asc',
		        ];

		        $pages = mso_get_pages($params, $pag);

		        foreach ( $pages as $k => $page ) {
			        $comments = $page['page_count_comments'] ? mso_get_comments($page['page_id']) : [];
                    $pages[$k]['page_comments'] = $comments;
		        }
		        $this->sendJson($pages, 200);
		        break;


            default: //todo: return list of the usable urls
		        $res = 'Wrong endpoint. ';
		        $res .= 'Please try this: /export_api/v1/categories. ';
		        $res .= 'Or this: export_api/v1/category/{category_number}/pages';

	            $this->sendJson($res,404);
        }

    }

    function sendJson($response, $status_code = null)
    {
        @header('Content-Type: application/json; charset=UTF-8');
        if (null !== $status_code) {
            http_response_code($status_code);
        }
        echo json_encode($response);

        exit();
    }
}
