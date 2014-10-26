<?php
class userItem extends \Eloquent {
    public $table = "userItem";
    
    public static function remove($id)
    {
  	    $obj = userItem :: find($id);
  	    if(count($obj) > 0)
  	    {
		    return $obj -> delete();
  	    }
    }

    public static function getOne($id)
    {
  	    return userItem::find($id);
    }
  
    public static function getList()
    {
  	    return userItem::get();
    }

    public static function getUserList($user_id)
    {
       return userItem::join('item', 'item.id', '=', 'userItem.item_id')
                        ->join('modelList', 'modelList.id', '=', 'item.modelList_id') 
                        ->select('modelList.*')
                        ->where( 'userItem.user_id',$user_id)
                        ->get(); 
    }

    public static function updateuser_id($id , $user_id)
    {
  	     $obj = userItem::getOne($id);
  	     if(count($obj) > 0)
  	     {
   		     $obj -> user_id = $user_id;
  		     $obj -> save();
  	     }
    }
   
    public static function updateitem_id($id , $item_id)
    {
  	     $obj = userItem::getOne($id);
  	     if(count($obj) > 0)
  	     {
   		     $obj -> item_id = $item_id;
  		     $obj -> save();
  	     }
    }
     
    public static function insert($user_id, $item_id)
    {
        $obj = new userItem();
        $obj -> user_id = $user_id;
        $obj -> item_id = $item_id;
        $obj -> save();
        return $obj -> id;
    }

}