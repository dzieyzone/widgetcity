
/**
 * Check value of cache_block to see if
 * we need to hide or show the additional settings.
 */
function BlockCacheAlterCheck() {
  var blockcache = $('#edit-cache-block');
  var selected = blockcache[0].options[blockcache[0].selectedIndex].value;
  if (selected == '-1') {
    toggleBlockCacheAlter('hide');
  }
  else {
    toggleBlockCacheAlter('show');
  }
}

/**
 * Show or hide additional blockcache settings.
 */
function toggleBlockCacheAlter(type) { 
  if (type == 'hide') {
    $('#blockcache_alter_wrapper').hide('slow');
  }
  else {
    $('#blockcache_alter_wrapper').show('slow'); 
  } 
}