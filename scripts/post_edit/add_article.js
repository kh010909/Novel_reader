var block_to_insert ;
var container_block ;
 
block_to_insert = document.createElement( 'div' );
block_to_insert.innerHTML = 'This demo DIV block was inserted into the page using JavaScript.' ;
 
container_block = document.getElementById( 'democontainer' );
container_block.appendChild( block_to_insert );
//add js link to post_edit
//turn new article button turn into dropdown