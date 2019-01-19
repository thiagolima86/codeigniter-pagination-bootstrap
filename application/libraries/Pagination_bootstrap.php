<?php defined('BASEPATH') OR exit('No direct script access allowed');


/**
*----------------------------------------------------------------
*------------  CODEIGNITER  PAGINATION  BOOTSTRAP   -------------
*----------------------------------------------------------------
*
* Pagination_Bootstrap is a codeigniter solution for pagination _layout_bootstrap
*
* Call library: $this->load->library("pagination_bootstrap");
* Set: $this->pagination_bootstrap->config("/myControler/index", $this->db->get('table'));
* Get result: $this->pagination_bootstrap->result()
* Render pagination : <?php echo $this->pagination_bootstrap->render(); ?>
*
* @author Thiago Lima <thiagolima86gmail.com>
* @version 1.0
* @access public
*/



class Pagination_Bootstrap {

  private $first_link = "<< ";
  private $last_link = " >>";
  private $next_link = " >";
  private $prev_link = "< ";
  private $offset = 5;


  private $get;
  private $init;
  private $CI;


  public function __construct(){

    $this->CI =& get_instance();
    $this->CI->load->library('pagination');

  }

/**
* Configure and return rows data.
* Ex: $this->pagination_bootstrap->config("myControler/index", $this->db->get())
* @param string $url write relative url for page pagination
* @param object $get insert the object return from codeigniter query
* @return object selected to show in view
*/

  public function config($url, $get){
    $this->CI->load->helper('url');

    $this->get = $get;
    // layout
    $config = $this->_layout_bootstrap();

    $config['first_link'] = $this->first_link;
    $config['last_link'] = $this->last_link;
    $config['next_link'] = $this->next_link;
    $config['prev_link'] = $this->prev_link;
    $config['base_url'] = $this->CI->config->item('base_url').$url.'/page/';
    $config['total_rows'] = $get->num_rows();
    $config['per_page'] = $this->offset;

    $currentPage = $this->CI->uri->segment(4);
    $currentPage = $currentPage==0?0:$currentPage;

    $this->init = $currentPage;

    $this->CI->pagination->initialize($config);

    return $this->result();
  }




  /**
  * offset max limit for select
  * @param int $value max number for return select
  */
  public function offset($value){
    $this->offset = $value;
  }


  /**
  * Set names for html link
  * Ex: $data = array('first' => 'go to first', 'last' => 'go to last', 'next' => 'next', 'prev' => 'prev');
  * $this->pagination_bootstrap->set_links($data);
  * @param array $array ex:
  * @return void
  */
  public function set_links($array){
    if(!empty($array['first'])){
      $this->first_link = $array['first'];
    }
    if(!empty($array['last'])){
      $this->last_link = $array['last'];
    }
    if(!empty($array['next'])){
      $this->next_link = $array['next'];
    }
    if(!empty($array['prev'])){
      $this->prev_link = $array['prev'];
    }
    return;
  }


  /**
  * Render html pagination with bootstrap in view
  * @return string html
  */
  public function render(){
    return $this->CI->pagination->create_links();
  }


  /**
  * Result object for this page
  * @return object rows for view in this page
  */
  public function result(){
    return $this->_return($this->get->result());
  }


  /**
  * Result array for this page
  * @return array rows for view in this page
  */
  public function result_array(){
    return $this->_return($this->get->result_array());
  }


  /**
  * return object or array data
  * @param $data data of get(), result database
  * @return mixing object or array data
  */
  private function _return($data){
    $i=0;
    foreach ($data as $key => $value) {
      if($key >= $this->init){

        $result[] = $value;
        $i++;
        if($i >= $this->offset){
          break;
        }

      }
    }
    return $result;
  }



  /**
  * config layout pagination bootstrap
  * @return array $config
  */
  private function _layout_bootstrap(){
    $config['attributes'] = array('class' => 'page-link');
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['cur_tag_open'] ='<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">';
    $config['num_tag_open'] =
    $config['first_tag_open'] =
    $config['last_tag_open'] =
    $config['next_tag_open'] =
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_close'] =
    $config['first_tag_close'] =
    $config['last_tag_close'] =
    $config['next_tag_close'] =
    $config['prev_tag_close'] = '</li>';
    return $config;
  }

}
