# Codeigniter Pagination Bootstrap

## install
Extract this library in **application/libraries** folder, in your codeigniter project
Load the library into method in yout controller. 
`$this->load->library("pagination_bootstrap");`

## Use
@param string $url  relative url to Controller and Method
@param object $get is method get of table in database
@return object data for use in loop
`$this->pagination_bootstrap->config($url, $get);`

**Simple use:**

in method controller:
```
$this->db->select('*');
$get = $this->db->get('table');
$result = $this->pagination_bootstrap->config("/myControler/index", $get); //configure your pagination
$this->load->view('my_view', array('result'=> $result));
```
view:
```
<?php
  /*loop your result*/ 
  foreach($result as $row){
        /*use the object */
  }
?>

<!-- render html link pagination -->
<?php echo $this->pagination_bootstrap->render(); ?>
```

**advanced use:**

in method controller:
```
$this->db->select('*');
$get = $this->db->get('table');
//number per page
$this->pagination_bootstrap->offset(10); 
//set name to links
$this->pagination_bootstrap->set_links(array('first' => 'go to first', 
                                             'last' => 'go to last',
                                             'next' => 'next',
                                             'prev' => 'prev'));

//configure your pagination
$this->pagination_bootstrap->config("/myControler/index", $get); 

//load view
$this->load->view('my_view');
```
view:
```
<?php
  /*loop your result. You can use the method ->result_array() too */ 
  foreach($this->pagination_bootstrap->result() as $row){
        /*use the object */
  }
?>

<!-- render html link pagination -->
<?php echo $this->pagination_bootstrap->render(); ?>
```

Thanks, one video tutorial created by **Husmukh HD Muhammad**. 

https://youtu.be/uZgewJU7mrg
