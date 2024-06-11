<?php 
namespace Dcone\Blocks;
class DconeBlockFunctions{

    function __construct(){
        // register block category 
        add_filter( 'block_categories_all', array($this, 'dcone_blocks_filter_block_categories') );
    }

    public function dcone_blocks_filter_block_categories( $categories ) {

        // Adding a new category.
        $categories[] = array(
            'slug'  => 'dcone-blocks',
            'title' => 'Dcone Blocks'
        );
    
        return $categories;
    }
    
}