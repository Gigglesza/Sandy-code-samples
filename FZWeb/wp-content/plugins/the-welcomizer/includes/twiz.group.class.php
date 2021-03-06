<?php
/*  Copyright 2014  Sébastien Laframboise  (email:wordpress@sebastien-laframboise.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
    
class TwizGroup extends Twiz{
  
    function __construct(){
    
        parent::__construct();
    }

    function getHtmlFormGroup( $id = '', $section_id = '' ){

        $twiz_group_name = '';
        $twiz_group_start_delay = '';
        $twiz_status = '';
        
        if($id != ''){
            
            if(!$data = $this->getRow($id)){return '';}
            
            $twiz_group_name = $data[parent::F_LAYER_ID];
            $twiz_group_start_delay = $data[parent::F_START_DELAY];
            $twiz_export_id = $data[parent::F_EXPORT_ID];
            $twiz_status = ( $data[parent::F_STATUS] == '1' ) ? ' checked="checked"' : '';
            $action = __('Edit', 'the-welcomizer');

        }else{
            
            $action = __('Add New', 'the-welcomizer');
            $twiz_status = ' checked="checked"';
            $twiz_export_id = uniqid();
        }      
    
            $jsscript = '<script>
 //<![CDATA[
 jQuery(document).ready(function($) {
 twiz_view_id = null;';
 
        $jsscript .= '
$("[name^=twiz_listmenu]").css("display", "none");
';


        $jsscript .= '});
 //]]>
</script>';

        $html = '<div class="twiz-box-menu"><div class="twiz-text-right twiz-float-right">'.__('Action', 'the-welcomizer').'<div class="twiz-green">'.$action.'</div></div>'.__('Status', 'the-welcomizer').': <input type="checkbox" id="twiz_group_'.parent::F_STATUS.'" name="twiz_group_'.parent::F_STATUS.'" '.$twiz_status.'/>';

        $html .='<br>'.__('Group name', 'the-welcomizer').': ';
        $html .= '<input type="text" id="twiz_group_name" name="twiz_group_name"  value="'.$twiz_group_name.'" maxlength="27" class="twiz-input twiz-input-focus"/>';

        // cancel and save button
        $html .= '<div class="twiz-clear"></div><div class="twiz-text-right"><span id="twiz_group_save_img_box" name="twiz_group_save_img_box" class="twiz-loading-gif-save"></span><a name="twiz_group_cancel" id="twiz_group_cancel">'.__('Cancel', 'the-welcomizer').'</a> <input type="button" name="twiz_group_save" id="twiz_group_save" class="button-primary" value="'.__('Save', 'the-welcomizer').'" /><input type="hidden" value="'.$id.'" id="twiz_group_id" name="twiz_group_id"/><input type="hidden" name="twiz_group_'.parent::F_EXPORT_ID.'" id="twiz_group_'.parent::F_EXPORT_ID.'" value="'.$twiz_export_id.'"/></div>';
        
        $html .= '</div>'.$jsscript;
        
        return $html;
    }
    
    function copyGroup( $groupid = '', $section_id = ''){

        global $wpdb;
        
        if( $groupid == '' ){return false;}
        
        $old_exportid = $this->getValue($groupid, parent::F_EXPORT_ID);
        $new_export_id = uniqid();
        
                       
        $sql = "INSERT INTO ".$this->table." 
               SELECT NULL
              ,IF(".parent::F_PARENT_ID." = '". $old_exportid ."','". $new_export_id ."','')
              ,IF(".parent::F_EXPORT_ID." = '". $old_exportid ."','". $new_export_id ."', md5(date_format(date_add(sysdate(), INTERVAL FLOOR( 1 + (RAND() * 998)) MICROSECOND),\"%Y%m%d%H%i%s%f\")))
              ,".parent::F_SECTION_ID."
              ,".parent::F_STATUS."
              ,".parent::F_TYPE."
              ,".parent::F_LAYER_ID."
              ,".parent::F_ON_EVENT."                  
              ,".parent::F_LOCK_EVENT."                  
              ,".parent::F_LOCK_EVENT_TYPE."                  
              ,".parent::F_START_DELAY."
              ,".parent::F_DURATION."
              ,".parent::F_DURATION_B."
              ,".parent::F_OUTPUT."
              ,".parent::F_OUTPUT_POS."
              ,".parent::F_JAVASCRIPT."
              ,".parent::F_CSS."
              ,".parent::F_START_ELEMENT_TYPE."
              ,".parent::F_START_ELEMENT."
              ,".parent::F_START_TOP_POS_SIGN."
              ,".parent::F_START_TOP_POS."
              ,".parent::F_START_TOP_POS_FORMAT."
              ,".parent::F_START_LEFT_POS_SIGN."
              ,".parent::F_START_LEFT_POS."    
              ,".parent::F_START_LEFT_POS_FORMAT."    
              ,".parent::F_POSITION."    
              ,".parent::F_ZINDEX."    
              ,".parent::F_EASING_A." 
              ,".parent::F_EASING_B." 
              ,".parent::F_MOVE_ELEMENT_TYPE_A."
              ,".parent::F_MOVE_ELEMENT_A."                   
              ,".parent::F_MOVE_TOP_POS_SIGN_A."
              ,".parent::F_MOVE_TOP_POS_A."
              ,".parent::F_MOVE_TOP_POS_FORMAT_A."
              ,".parent::F_MOVE_LEFT_POS_SIGN_A."
              ,".parent::F_MOVE_LEFT_POS_A."
              ,".parent::F_MOVE_LEFT_POS_FORMAT_A."
              ,".parent::F_MOVE_ELEMENT_TYPE_B."
              ,".parent::F_MOVE_ELEMENT_B."                  
              ,".parent::F_MOVE_TOP_POS_SIGN_B."
              ,".parent::F_MOVE_TOP_POS_B."
              ,".parent::F_MOVE_TOP_POS_FORMAT_B."
              ,".parent::F_MOVE_LEFT_POS_SIGN_B."
              ,".parent::F_MOVE_LEFT_POS_B."
              ,".parent::F_MOVE_LEFT_POS_FORMAT_B."
              ,".parent::F_OPTIONS_A."
              ,".parent::F_OPTIONS_B."
              ,".parent::F_EXTRA_JS_A."
              ,".parent::F_EXTRA_JS_B."    
              ,".parent::F_GROUP_ORDER."    
              ,0    
              FROM ".$this->table." WHERE ".parent::F_ID." = '".$groupid."' OR ".parent::F_PARENT_ID." = '".$old_exportid."'";
        
        if($code = $wpdb->query($sql)){
        
            $code = $this->cleanCopiedGroup( $groupid, $old_exportid, $new_export_id);
        }
        
        $new_id = $this->getId(parent::F_EXPORT_ID, $new_export_id);
        
        $this->toggle_option[$this->userid][parent::KEY_TOGGLE_GROUP][$new_export_id] = 1;
        $code = update_option('twiz_toggle', $this->toggle_option);
        
        $ok = $this->reInitializeGroupOrder( $section_id );

        return $new_id;
    }
    
    private function cleanCopiedGroup( $groupid = '', $old_exportid = '', $new_export_id = '' ){
        
        global $wpdb;
        
        $oldarrayid =  array();
        
        // Replace rows exportid
        $listarray = $this->getListArray("WHERE ".parent::F_PARENT_ID." = '".$old_exportid."'");
        
        foreach ( $listarray as $value ){
        
                $oldarrayid[$value[parent::F_ID]] = $value[parent::F_EXPORT_ID];
        }
                  
        $listarray = $this->getListArray("WHERE ".parent::F_PARENT_ID." = '".$new_export_id."'");
        
        foreach ( $oldarrayid as $oldvalue ){
            
            // loop all rows 
            foreach ( $listarray as $value1 ){
                 
                 // loop all rows 
                 foreach ( $listarray as $value ){
                    
                    // Replace all current exportid. all functions and activations vars included
                    $updatesql = "UPDATE ".$this->table . " SET
                     ". parent::F_JAVASCRIPT . " = replace(". parent::F_JAVASCRIPT . ", '_".$value1[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($value1[parent::F_LAYER_ID]))."_".$oldvalue."', '_".$value1[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($value1[parent::F_LAYER_ID]))."_".$value1[parent::F_EXPORT_ID]."') 
                    ,". parent::F_EXTRA_JS_A . " = replace(". parent::F_EXTRA_JS_A . ", '_".$value1[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($value[parent::F_LAYER_ID]))."_".$oldvalue."', '_".$value1[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($value1[parent::F_LAYER_ID]))."_".$value1[parent::F_EXPORT_ID]."') 
                    ,". parent::F_EXTRA_JS_B . " = replace(". parent::F_EXTRA_JS_B . ", '_".$value1[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($value1[parent::F_LAYER_ID]))."_".$oldvalue."', '_".$value1[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($value1[parent::F_LAYER_ID]))."_".$value1[parent::F_EXPORT_ID]."') 
                    WHERE ".parent::F_ID." = ".$value[parent::F_ID]."";

                    $code = $wpdb->query($updatesql);
                }                
            }
        }
        
        // Replace Group only exportid
        $oldarrayid = $this->getListArray("WHERE ".parent::F_ID." = '".$groupid."' ");
 
        $listarray = $this->getListArray("WHERE ".parent::F_PARENT_ID." = '".$new_export_id."'");

        foreach ( $oldarrayid as $oldvalue ){
        
            // loop all rows 
            foreach ( $listarray as $value1 ){

                    // Replace all current exportid. all functions and activations vars included
                    $updatesql = "UPDATE ".$this->table . " SET
                     ". parent::F_JAVASCRIPT . " = replace(". parent::F_JAVASCRIPT . ", '_".$oldvalue[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($oldvalue[parent::F_LAYER_ID]))."_".$oldvalue[parent::F_EXPORT_ID]."', '_".$oldvalue[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($oldvalue[parent::F_LAYER_ID]))."_".$new_export_id."') 
                    ,". parent::F_EXTRA_JS_A . " = replace(". parent::F_EXTRA_JS_A . ", '_".$oldvalue[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($oldvalue[parent::F_LAYER_ID]))."_".$oldvalue[parent::F_EXPORT_ID]."', '_".$oldvalue[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($oldvalue[parent::F_LAYER_ID]))."_".$new_export_id."') 
                    ,". parent::F_EXTRA_JS_B . " = replace(". parent::F_EXTRA_JS_B . ", '_".$oldvalue[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($oldvalue[parent::F_LAYER_ID]))."_".$oldvalue[parent::F_EXPORT_ID]."', '_".$oldvalue[parent::F_SECTION_ID] ."_".str_replace("-","_",sanitize_title_with_dashes($oldvalue[parent::F_LAYER_ID]))."_".$new_export_id."') 
                    WHERE ".parent::F_ID." = ".$value1[parent::F_ID]."";

                    $code = $wpdb->query($updatesql);
                
            }
        }
            
        return true;
    }
    
    function getHTMLGroupList( $section_id = '' ){
    
        $where = " WHERE ".parent::F_TYPE."='".parent::ELEMENT_TYPE_GROUP."' and ".parent::F_SECTION_ID." = '".$section_id."'";
        $listarray = $this->getListArray( $where );
        
        // Animations
        $html = '<select class="twiz-slc-group" id="twiz_slc_group" name="twiz_slc_group">';
        $html .= '<option value="">'.__('(Optional)', 'the-welcomizer').'</option>';

        foreach ( $listarray as $value ){

            $html .= '<option value="'.$value[parent::F_EXPORT_ID].'">'.$value[parent::F_ID].' - '.$value[parent::F_LAYER_ID].'</option>';
        }
        
        $html .= '</select>';

        return $html;    
    
    
    }
    
    function deleteGroup( $id = '', $section_id = '' ){
    
        global $wpdb;
        
        if( $id == '' ){return false;}
        
        $exportid = $this->getValue($id, parent::F_EXPORT_ID);
         
        $clean = $this->cleanTwizFunction( $id );
        
        $sql = "DELETE FROM ".$this->table." WHERE ".parent::F_ID." = '".$id."' OR ".parent::F_PARENT_ID." = '".$exportid."';";
        $code = $wpdb->query($sql);
        
        // Unset Toggle
        $this->toggle_option[$this->userid][parent::KEY_TOGGLE_GROUP][$exportid] = '';
        unset($this->toggle_option[$this->userid][parent::KEY_TOGGLE_GROUP][$exportid]);
        $code = update_option('twiz_toggle', $this->toggle_option);
    
        $ok = $this->reInitializeGroupOrder( $section_id );
            
        return true;
    }
    
    function initializeGroupOrder( $section_id = '' ){

        $where = " WHERE ".parent::F_TYPE."='".parent::ELEMENT_TYPE_GROUP."' and ".parent::F_SECTION_ID." = '".$section_id."'";
        $listarray = $this->getListArray( $where, '' ); // get all the data

        $i = 1;
        foreach( $listarray as $key => $value ){ // initialize   
         
            if( $value[parent::F_GROUP_ORDER] == '0' ){
            
                $code = $this->saveGroupValue( $value[parent::F_EXPORT_ID], parent::F_GROUP_ORDER, $i); 
            }
            $i++;
        }
        
        $i = ($i == 1) ? 1 : $i - 1; // 1 is min
        
        return $i;
    }
    
    function reInitializeGroupOrder( $section_id = '' ){

        $where = " WHERE ".parent::F_TYPE."='".parent::ELEMENT_TYPE_GROUP."' and ".parent::F_SECTION_ID." = '".$section_id."'";
        $listarray = $this->getListArray( $where, '' ); // get all the data

        $i = 1;
        foreach( $listarray as $key => $value ){ // initialize   
            
            $code = $this->saveGroupValue( $value[parent::F_EXPORT_ID], parent::F_GROUP_ORDER, $i); 
            
            $i++;
        }

        return true;
    }    
    
    function updateGroupOrder( $id = '', $order = '', $section_id = ''){
           
        $ibase = 1;
           
        $origorder = $this->getValue($id, parent::F_GROUP_ORDER);
        $neworder = $origorder;
        $exportid = $this->getValue($id, parent::F_EXPORT_ID);
        
        $maxkeyorder = $this->initializeGroupOrder( $section_id );

        // get fresh array
        $where = " WHERE ".parent::F_TYPE."='".parent::ELEMENT_TYPE_GROUP."' and ".parent::F_SECTION_ID." = '".$section_id."'";
        $listarray = $this->getListArray( $where, '' ); // get all the data
        
        $i = 1;

        foreach( $listarray as $key => $value ){ // update / set order

            if( $value[parent::F_ID] == $id ){
            
                $ibase = $i;  
                $neworder = $i;
                
                switch($order){

                    case parent::LB_ORDER_UP:

                        $neworder = $neworder - 1;
                        break;
                        
                    case parent::LB_ORDER_DOWN:
                        
                        $neworder = $neworder + 1;
                        break;
                }
                
                $neworder = ( $neworder < 1 ) ? 1 : $neworder;

                if( $maxkeyorder > 1 ){
                
                   $neworder = ( $neworder > $maxkeyorder ) ? $maxkeyorder : $neworder;
                   
                }else if ($maxkeyorder == 1 ){
                
                   $neworder = 1;
                }
            }
            $i++;
         }
         
         $i = 1;
         
         foreach( $listarray as $key => $value ){ // update / set order    
         
            if( $value[parent::F_GROUP_ORDER] == $neworder ){
            
                $code = $this->saveGroupValue( $value[parent::F_EXPORT_ID], parent::F_GROUP_ORDER, $ibase); 
                
            }else{
            
                $code = $this->saveGroupValue( $value[parent::F_EXPORT_ID], parent::F_GROUP_ORDER, $i); 
            }
            $i++;
        }

        foreach( $listarray as $key => $value ){ // switch order

            if( $value[parent::F_ID] == $id ){
            
                $code = $this->saveGroupValue( $value[parent::F_EXPORT_ID], parent::F_GROUP_ORDER, $neworder);    
            }             
        }

        return true;
    }
    
    function saveGroupValue( $exportid = '', $column = '', $value = '' ){ 
        
        global $wpdb;
            
        if( $exportid == '' ){return false;}
        if( $column == '' ){return false;}
    
        $sql = "UPDATE ".$this->table." 
                SET ".$column." = '".$value."'                 
                WHERE ".parent::F_EXPORT_ID." = '".$exportid."'
                OR ".parent::F_PARENT_ID." = '".$exportid."';";
        $code = $wpdb->query($sql);
                   
        return $exportid;
    }
    
    
    function saveGroup( $id = '', $section_id = ''){
    
        if ($id == '') {       
           $ok = $this->initializeGroupOrder( $section_id );
           $group_order = 0;
            
        }else{
        
           $group_order = $this->getValue($id, parent::F_GROUP_ORDER);
        }

        // mapping                 
        $_POST['twiz_'.parent::F_EXPORT_ID] = esc_attr(trim($_POST['twiz_group_'.parent::F_EXPORT_ID]));
        $_POST['twiz_'.parent::F_STATUS] = esc_attr(trim($_POST['twiz_group_'.parent::F_STATUS]));
        $_POST['twiz_'.parent::F_LAYER_ID] = esc_attr(trim($_POST['twiz_group_name']));
        $_POST['twiz_'.parent::F_TYPE] = parent::ELEMENT_TYPE_GROUP;
        $_POST['twiz_'.parent::F_ON_EVENT] = parent::EV_MANUAL;
        $_POST['twiz_'.parent::F_GROUP_ORDER] = $group_order;
    
        $exportid = $_POST['twiz_'.parent::F_EXPORT_ID];
        
        // Set Toggle On
        $this->toggle_option[$this->userid][parent::KEY_TOGGLE_GROUP][$exportid] = 1;
        $code = update_option('twiz_toggle', $this->toggle_option);

        $arr = $this->save( $id );
        
        if ($id == '') {       
       
           $ok = $this->reInitializeGroupOrder( $section_id );
        }        
    
        return $arr;
    }    
}?>