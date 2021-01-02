<?php
 
/**
* @file
* Contains \Drupal\extend_site_info\Controller\GeneralController.php
*
*/
 
namespace Drupal\extend_site_info\Controller;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\node\Entity\Node;
use Drupal\Core\Access\AccessResult;

class GeneralController extends ControllerBase {
  /**
   * Returns node json of page content type.
   */
	public function get_node_json_of_page($siteapikey, $nid){
		if(!empty($siteapikey) && $nid !== '' && is_numeric($nid)){
			$data = '';
			$serializer = \Drupal::service('serializer');
			$node = Node::load($nid);
			if(!empty($node) && $node->isPublished() && $node->getType() == 'page'){
				$data = $serializer->serialize($node, 'json', ['plugin_id' => 'entity']);
			}
			return new Response($data);
		} else {
			return AccessResult::forbidden();
		}
	}
}